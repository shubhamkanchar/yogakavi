<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $signature = $request->header('X-Razorpay-Signature');
        $secret = config('services.razorpay.secret');

        $expected = hash_hmac('sha256', $request->getContent(), $secret);

        abort_if($signature !== $expected, 403);

        if ($request['event'] === 'payment.failed') {
            // log failure
        }

        if ($request['event'] === 'payment.captured') {
            // mark payment success if needed
        }

        return response()->json(['status' => 'ok']);
    }
}
