<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation;
use App\Services\SmsService;
use App\Services\PesaPalService;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    protected $pesaPal;

    public function __construct(PesaPalService $pesaPal)
    {
        $this->pesaPal = $pesaPal;
    }

    public function index()
    {
        return view('public.checkout'); // Ensure this Blade view exists
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string|max:500',
            'payment_method' => 'required|in:mobile_money,airtel_money,visa,mastercard',
            'mobile_number' => 'nullable|string|max:20',
            'card_number' => 'nullable|string|max:20',
            'card_expiry' => 'nullable|string|max:5',
            'card_cvc' => 'nullable|string|max:4',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return back()->withErrors(['cart' => 'Your cart is empty.']);
        }

        $vehicle = $cart[0]['name'] ?? 'Unknown Vehicle';
        $amount = $cart[0]['price'] ?? 0;

        $order = Order::create([
            'user_id' => auth()->check() ? auth()->id() : null,
            'order_number' => 'ORD-' . strtoupper(Str::random(10)),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'vehicle' => $vehicle,
            'amount' => $amount,
            'total_price' => $amount,
            'status' => 'pending',
        ]);

        $payment = Payment::create([
            'order_id' => $order->id,
            'payment_reference' => strtoupper(Str::uuid()),
            'method' => $validated['payment_method'],
            'status' => 'pending',
            'paid_at' => now(),
        ]);

        $payload = [
            'amount' => $amount,
            'currency' => 'UGX',
            'description' => 'Carvado Vehicle Order',
            'type' => 'MERCHANT',
            'reference' => $payment->payment_reference,
            'email' => $validated['email'],
            'phone_number' => $validated['mobile_number'] ?? $request->user()->phone ?? '+256000000000',
            'callback_url' => env('PESAPAL_CALLBACK_URL'),
            'payment_method' => $validated['payment_method'],
            'card_details' => [
                'number' => $validated['card_number'] ?? null,
                'expiry' => $validated['card_expiry'] ?? null,
                'cvc' => $validated['card_cvc'] ?? null,
            ],
        ];

        $response = $this->pesaPal->initiatePayment($payload);

        Mail::to($validated['email'])->send(new OrderConfirmation($order, $validated['email'], $validated['name']));

        if (config('services.sms.enabled')) {
            SmsService::send($validated['mobile_number'] ?? null, "Your Carvado order #{$order->order_number} is confirmed.");
        }

        return redirect()->route('payment.confirmation', [
            'order' => $order->id,
            'trackingId' => $response['order_tracking_id'] ?? null,
        ]);
    }


    public function thankyou(Request $request)
    {
        $orderId = session('order_id');
        return view('public.thankyou', compact('orderId'));
    }

    public function invoice($id)
    {
        $order = Order::findOrFail($id);
        return view('public.invoice', compact('order'));
    }
}
