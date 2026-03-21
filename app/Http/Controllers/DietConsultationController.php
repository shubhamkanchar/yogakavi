<?php

namespace App\Http\Controllers;

use App\Models\DietConsultation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Razorpay\Api\Api;

class DietConsultationController extends Controller
{
    public function index()
    {
        return view('form.diet_consultation');
    }

    public function createOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'call_back_datetime' => 'required|date',
        ]);

        $consultation = DietConsultation::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'call_back_datetime' => $request->call_back_datetime,
            'status' => 'pending',
        ]);

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $amount = 100 * 100; // 100 INR in paise

        $order = $api->order->create([
            'receipt' => (string) $consultation->id,
            'amount' => $amount,
            'currency' => 'INR',
            'notes' => [
                'type' => 'diet_consultation',
                'consultation_id' => $consultation->id,
            ]
        ]);

        $consultation->update(['razorpay_order_id' => $order->id]);

        return response()->json([
            'id' => $order->id,
            'amount' => $order->amount,
            'consultation_id' => $consultation->id
        ]);
    }

    public function verifyPayment(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try {
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Signature Verification Failed'], 400);
        }

        $consultation = DietConsultation::where('razorpay_order_id', $request->razorpay_order_id)->first();
        if ($consultation) {
            $consultation->update([
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'status' => 'paid',
            ]);
        }

        session()->flash('success', 'Payment Successful! We will contact you at the requested time.');

        return response()->json(['status' => 'success', 'redirect_url' => url('/')]);
    }
}
