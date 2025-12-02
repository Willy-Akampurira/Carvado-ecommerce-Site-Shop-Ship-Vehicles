<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PesaPalService
{
    public function initiatePayment(array $payload)
    {
        return Http::withOptions(['verify' => false]) // 👈 Bypass SSL for local dev
            ->withBasicAuth(
                env('PESAPAL_CONSUMER_KEY'),
                env('PESAPAL_CONSUMER_SECRET')
            )
            ->post(env('PESAPAL_BASE_URL') . '/api/PostPesapalDirectOrderV4', $payload)
            ->json();
    }

    public function queryPaymentStatus(string $trackingId)
    {
        return Http::withOptions(['verify' => false]) // 👈 Bypass SSL for local dev
            ->withBasicAuth(
                env('PESAPAL_CONSUMER_KEY'),
                env('PESAPAL_CONSUMER_SECRET')
            )
            ->get(env('PESAPAL_BASE_URL') . '/api/querypaymentdetails', [
                'orderTrackingId' => $trackingId
            ])
            ->json();
    }
}
