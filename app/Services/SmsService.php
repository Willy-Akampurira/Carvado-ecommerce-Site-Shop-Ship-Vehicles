<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use AfricasTalking\SDK\AfricasTalking;

class SmsService
{
    public static function send($to, $message)
    {
        if (!config('services.sms.enabled') || empty($to)) {
            Log::info("SMS skipped: disabled or missing recipient.");
            return;
        }

        $provider = config('services.sms.provider');

        switch ($provider) {
            case 'africastalking':
                $username = config('services.sms.username');
                $apiKey = config('services.sms.api_key');
                $senderId = config('services.sms.sender_id');

                try {
                    $AT = new AfricasTalking($username, $apiKey);
                    $sms = $AT->sms();

                    $result = $sms->send([
                        'to' => $to,
                        'message' => $message,
                        'from' => $senderId,
                    ]);

                    Log::info("Africa's Talking SMS sent", [
                        'to' => $to,
                        'message' => $message,
                        'response' => $result,
                    ]);
                } catch (\Exception $e) {
                    Log::error("Africa's Talking SMS failed: " . $e->getMessage());
                }
                break;

            case 'twilio':
                Log::warning("Twilio SMS provider not yet implemented.");
                break;

            default:
                Log::warning("SMS provider [$provider] not supported.");
        }
    }
}
