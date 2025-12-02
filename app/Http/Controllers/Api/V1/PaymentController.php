<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use App\Services\PesaPalService;

class PaymentController extends Controller
{
    protected $pesaPal;

    public function __construct(PesaPalService $pesaPal)
    {
        $this->pesaPal = $pesaPal;
    }

    public function status(string $trackingId): JsonResponse
    {
        $status = $this->pesaPal->queryPaymentStatus($trackingId);

        return response()->json([
            'tracking_id' => $trackingId,
            'status' => $status,
        ]);
    }

    public function index(): JsonResponse
    {
        $payments = Payment::whereHas('order', fn ($query) =>
            $query->where('user_id', Auth::id())
        )
        ->latest('paid_at')
        ->get();

        return response()->json($payments);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'amount_paid' => 'required|numeric|min:0',
            'method' => 'required|in:card,mobile_money,paypal,bank_transfer',
            'transaction_id' => 'nullable|string|max:255',
        ]);

        $payment = Payment::create([
            'order_id' => $validated['order_id'],
            'payment_reference' => strtoupper(Str::uuid()),
            'method' => $validated['method'],
            'status' => 'pending',
            'transaction_id' => $validated['transaction_id'],
            'paid_at' => now(),
        ]);

        // 🔁 Trigger PesaPal payment
        $payload = [
            'amount' => $validated['amount_paid'],
            'currency' => 'UGX',
            'description' => 'Carvado Vehicle Payment',
            'type' => 'MERCHANT',
            'reference' => $payment->payment_reference,
            'email' => $request->user()->email,
            'phone_number' => $request->user()->phone ?? '+256000000000',
            'callback_url' => env('PESAPAL_CALLBACK_URL'),
        ];

        $response = $this->pesaPal->initiatePayment($payload);

        return response()->json([
            'payment' => $payment,
            'pesapal_response' => $response,
        ], 201);
    }

    public function show(Payment $payment): JsonResponse
    {
        if ($payment->order->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($payment);
    }

    public function update(Request $request, Payment $payment): JsonResponse
    {
        if ($payment->order->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'status' => 'in:pending,completed,failed',
            'method' => 'in:card,mobile_money,paypal,bank_transfer',
        ]);

        $payment->update($validated);

        return response()->json($payment);
    }

    public function destroy(Payment $payment): JsonResponse
    {
        if ($payment->order->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $payment->delete();

        return response()->json(['message' => 'Payment deleted successfully']);
    }
}
