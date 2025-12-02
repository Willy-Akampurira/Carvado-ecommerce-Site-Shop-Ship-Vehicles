<x-mail::message>
# Order Confirmed 🎉

Hi {{ $order->name }},

Your order for **{{ $order->vehicle }}** has been successfully confirmed.

**Order Number:** {{ $order->order_number }}  
**Amount Paid:** UGX {{ number_format($order->amount, 0) }}  
**Delivery Address:** {{ $order->address }}

<x-mail::button :url="route('orders.show', $order->id)">
View Your Order
</x-mail::button>

Thanks for choosing Carvado!  
<br>
{{ config('app.name') }}
</x-mail::message>
