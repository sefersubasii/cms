<?php

namespace Xgenious\Paymentgateway\Http\Controllers;


use Illuminate\Http\Request;
use Xgenious\Paymentgateway\Facades\XgPaymentGateway;

class StripePaymentController extends Controller
{
    public function charge_customer(Request $request){
        $stripe_session = XgPaymentGateway::stripe()->charge_customer_from_controller([
            'amount' => (int) $request->amount,
            'title' => $request->title,
            'description' => $request->description,
            'ipn_url' => $request->ipn_url,
            'order_id' => $request->order_id,
            'track' => $request->track,
            'cancel_url' => $request->cancel_url,
            'success_url' => $request->success_url,
            'email' => $request->email,
            'name' => $request->name,
            'payment_type' => $request->payment_type
        ]);
        return response()->json(['id' => $stripe_session['id']]);
    }
}
