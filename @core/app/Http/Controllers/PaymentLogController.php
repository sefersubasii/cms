<?php

namespace App\Http\Controllers;

use App\Donation;
use App\DonationLogs;
use App\EventAttendance;
use App\EventPaymentLogs;
use App\Events;
use App\GigOrder;
use App\Mail\DonationMessage;
use App\Mail\PaymentSuccess;
use App\Mail\PlaceOrder;
use App\Order;
use App\PaymentLogs;
use App\PricePlan;
use App\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use KingFlamez\Rave\Facades\Rave;
use Mollie\Laravel\Facades\Mollie;
use Razorpay\Api\Api;
use Stripe\Charge;
use Stripe\Stripe;
use Unicodeveloper\Paystack\Facades\Paystack;
use Xgenious\Paymentgateway\Facades\XgPaymentGateway;

class PaymentLogController extends Controller
{

    protected function cancel_page(){
        return redirect()->route('frontend.order.payment.cancel.static');
    }

    public function order_payment_form(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'order_id' => 'required|string',
            'payment_gateway' => 'required|string',
        ]);
        $order_details = Order::find($request->order_id);
        $payment_log_id = PaymentLogs::create([
            'email' => $request->email,
            'name' => $request->name,
            'package_name' => $order_details->package_name,
            'package_price' => $order_details->package_price,
            'package_gateway' => $request->payment_gateway,
            'order_id' => $request->order_id,
            'status' => 'pending',
            'track' => Str::random(10) . Str::random(10),
        ])->id;
        $payment_details = PaymentLogs::find($payment_log_id);

        if ($request->payment_gateway === 'paypal') {

            $redirect_url = XgPaymentGateway::paypal()->charge_customer([
                'amount' => $payment_details->package_price,
                'title' => $payment_details->package_name,
                'description' => 'Payment For Package Order Id: #' . $request->order_id . ' Package Name: ' . $payment_details->package_name . ' Payer Name: ' . $request->name . ' Payer Email:' . $request->email,
                'ipn_url' => route('frontend.paypal.ipn'),
                'order_id' => 'Payment For Package Order Id: #'.$request->order_id,
                'track' => $payment_details->track,
                'cancel_url' => route('frontend.order.payment.cancel',$payment_details->id),
                'success_url' => route('frontend.order.payment.success', $payment_details->id),
                'email' => $payment_details->email, // user email
                'name' => $payment_details->name, // user name
                'payment_type' => 'order', // which kind of payment your are receiving
            ]);
            session()->put('order_id',$request->order_id);
            return redirect()->away($redirect_url);

        } elseif ($request->payment_gateway === 'paytm') {

            $redirect_url = XgPaymentGateway::paytm()->charge_customer([
                'amount' => $payment_details->package_price,
                'title' => $payment_details->package_name,
                'description' => 'Payment For Package Order Id: #' . $request->order_id . ' Package Name: ' . $payment_details->package_name . ' Payer Name: ' . $request->name . ' Payer Email:' . $request->email,
                'order_id' => $payment_details->order_id,
                'track' => $payment_details->track,
                'cancel_url' => route('frontend.order.payment.cancel',$payment_details->id),
                'success_url' => route('frontend.order.payment.success', $payment_details->id),
                'email' => $payment_details->email, // user email
                'name' => $payment_details->name, // user name
                'payment_type' => 'order', // which kind of payment your are receiving
                'ipn_url' => route('frontend.paytm.ipn')
            ]);
            return $redirect_url;



        } elseif ($request->payment_gateway === 'mollie') {

            $redirect_url = XgPaymentGateway::mollie()->charge_customer([
                'amount' => $payment_details->package_price,
                'title' => $payment_details->package_name,
                'description' => 'Payment For Package Order Id: #' . $request->order_id . ' Package Name: ' . $payment_details->package_name . ' Payer Name: ' . $request->name . ' Payer Email:' . $request->email,
                'order_id' => $payment_details->order_id,
                'track' => $payment_details->track,
                'cancel_url' => route('frontend.order.payment.cancel',$payment_details->id),
                'success_url' => route('frontend.order.payment.success', $payment_details->id),
                'email' => $payment_details->email, // user email
                'name' => $payment_details->name, // user name
                'payment_type' => 'order', // which kind of payment your are receiving
                'ipn_url' => route('frontend.mollie.ipn')
            ]);

            return $redirect_url;


        } elseif ($request->payment_gateway === 'stripe') {

            $redirect_url = XgPaymentGateway::stripe()->charge_customer([
                'amount' => $payment_details->package_price,
                'title' => $payment_details->package_name,
                'description' => 'Payment For Package Order Id: #' . $request->order_id . ' Package Name: ' . $payment_details->package_name . ' Payer Name: ' . $request->name . ' Payer Email:' . $request->email,
                'order_id' => $payment_details->order_id,
                'track' => $payment_details->track,
                'cancel_url' => route('frontend.order.payment.cancel',$payment_details->id),
                'success_url' => route('frontend.order.payment.success', $payment_details->id),
                'email' => $payment_details->email, // user email
                'name' => $payment_details->name, // user name
                'payment_type' => 'order', // which kind of payment your are receiving
                'ipn_url' => route('frontend.stripe.ipn')
            ]);

            return $redirect_url;

        } elseif ($request->payment_gateway === 'razorpay') {

            $redirect_url = XgPaymentGateway::razorpay()->charge_customer([
                'amount' => $payment_details->package_price,
                'title' => $payment_details->package_name,
                'description' => 'Payment For Package Order Id: #' . $request->order_id . ' Package Name: ' . $payment_details->package_name . ' Payer Name: ' . $request->name . ' Payer Email:' . $request->email,
                'order_id' => $payment_details->order_id,
                'track' => $payment_details->track,
                'cancel_url' => route('frontend.order.payment.cancel',$payment_details->id),
                'success_url' => route('frontend.order.payment.success', $payment_details->id),
                'email' => $payment_details->email, // user email
                'name' => $payment_details->name, // user name
                'payment_type' => 'order', // which kind of payment your are receiving
                'ipn_url' => route('frontend.razorpay.ipn')
            ]);

            return $redirect_url;

        } elseif ($request->payment_gateway === 'flutterwave') {

            $redirect_url = XgPaymentGateway::flutterwave()->charge_customer([
                'amount' => $payment_details->package_price,
                'title' => $payment_details->package_name,
                'description' => 'Payment For Package Order Id: #' . $request->order_id . ' Package Name: ' . $payment_details->package_name . ' Payer Name: ' . $request->name . ' Payer Email:' . $request->email,
                'order_id' => $payment_details->order_id,
                'track' => $payment_details->track,
                'cancel_url' => route('frontend.order.payment.cancel',$payment_details->id),
                'success_url' => route('frontend.order.payment.success', $payment_details->id),
                'email' => $payment_details->email, // user email
                'name' => $payment_details->name, // user name
                'payment_type' => 'order', // which kind of payment your are receiving
                'ipn_url' => route('frontend.flutterwave.ipn')
            ]);

            return $redirect_url;

        } elseif ($request->payment_gateway == 'paystack') {

            $redirect_url = XgPaymentGateway::paystack()->charge_customer([
                'amount' => $payment_details->package_price,
                'title' => $payment_details->package_name,
                'description' => 'Payment For Package Order Id: #' . $payment_details->order_id . ' Package Name: ' . $payment_details->package_name . ' Payer Name: ' . $request->name . ' Payer Email:' . $request->email,
                'order_id' => $payment_details->order_id,
                'track' => $payment_details->track,
                'cancel_url' => route('frontend.order.payment.cancel',$payment_details->id),
                'success_url' => route('frontend.order.payment.success', $payment_details->id),
                'email' => $payment_details->email, // user email
                'name' => $payment_details->name, // user name
                'payment_type' => 'order', // which kind of payment your are receiving
                'ipn_url' => route('frontend.paystack.ipn')
            ]);

            return $redirect_url;

        } elseif ($request->payment_gateway === 'midtrans') {

            $redirect_url = XgPaymentGateway::midtrans()->charge_customer([
                'amount' => $payment_details->package_price,
                'title' => $payment_details->package_name,
                'description' => 'Payment For Package Order Id: #' . $payment_details->order_id . ' Package Name: ' . $payment_details->package_name . ' Payer Name: ' . $request->name . ' Payer Email:' . $request->email,
                'order_id' => $payment_details->order_id,
                'track' => $payment_details->track,
                'cancel_url' => route('frontend.order.payment.cancel',$payment_details->id),
                'success_url' => route('frontend.order.payment.success', $payment_details->id),
                'email' => $payment_details->email, // user email
                'name' => $payment_details->name, // user name
                'payment_type' => 'order', // which kind of payment your are receiving
                'ipn_url' => route('frontend.midtrans.ipn')
            ]);


            return $redirect_url;

        } elseif ($request->payment_gateway === 'payfast') {

            $redirect_url = XgPaymentGateway::payfast()->charge_customer([
                'amount' => $payment_details->package_price,
                'title' => $payment_details->package_name,
                'description' => 'Payment For Package Order Id: #' . $payment_details->order_id . ' Package Name: ' . $payment_details->package_name . ' Payer Name: ' . $request->name . ' Payer Email:' . $request->email,
                'order_id' => $payment_details->order_id,
                'track' => $payment_details->track,
                'cancel_url' => route('frontend.order.payment.cancel',$payment_details->id),
                'success_url' => route('frontend.order.payment.success', $payment_details->id),
                'email' => $payment_details->email,
                'name' => $payment_details->name,
                'payment_type' => 'order',
                'ipn_url' => route('frontend.payfast.ipn')
            ]);


            return $redirect_url;

        } elseif ($request->payment_gateway == 'cashfree') {

            $redirect_url = XgPaymentGateway::cashfree()->charge_customer([
                'amount' => $payment_details->package_price,
                'title' => $payment_details->package_name,
                'description' => 'Payment For Package Order Id: #' . $request->order_id . ' Package Name: ' . $payment_details->package_name . ' Payer Name: ' . $request->name . ' Payer Email:' . $request->email,
                'order_id' => $payment_details->order_id,
                'track' => $payment_details->track,
                'cancel_url' => route('frontend.order.payment.cancel',$payment_details->id),
                'success_url' => route('frontend.order.payment.success', $payment_details->id),
                'email' => $payment_details->email, // user email
                'name' => $payment_details->name, // user name
                'payment_type' => 'order', // which kind of payment your are receiving
                'ipn_url' => route('frontend.cashfree.ipn')
            ]);


            return $redirect_url;

        }
        elseif ($request->payment_gateway == 'instamojo') {

            $redirect_url = XgPaymentGateway::instamojo()->charge_customer([
                'amount' => $payment_details->package_price,
                'title' => $payment_details->package_name,
                'description' => 'Payment For Package Order Id: #' . $request->order_id . ' Package Name: ' . $payment_details->package_name . ' Payer Name: ' . $request->name . ' Payer Email:' . $request->email,
                'order_id' => $payment_details->order_id,
                'track' => $payment_details->track,
                'cancel_url' => route('frontend.order.payment.cancel',$payment_details->id),
                'success_url' => route('frontend.order.payment.success', $payment_details->id),
                'email' => $payment_details->email, // user email
                'name' => $payment_details->name, // user name
                'payment_type' => 'order', // which kind of payment your are receiving
                'ipn_url' => route('frontend.instamojo.ipn')
            ]);

            return $redirect_url;
        }

        elseif ($request->payment_gateway == 'marcadopago') {

            $redirect_url = XgPaymentGateway::marcadopago()->charge_customer([
                'amount' => $payment_details->package_price,
                'title' => $payment_details->package_name,
                'description' => 'Payment For Package Order Id: #' .$request->order_id . ' Package Name: ' . $payment_details->package_name . ' Payer Name: ' . $request->name . ' Payer Email:' . $request->email,
                'order_id' => $payment_details->order_id,
                'track' => $payment_details->track,
                'cancel_url' => route('frontend.order.payment.cancel',$payment_details->id),
                'success_url' => route('frontend.order.payment.success', $payment_details->id),
                'email' => $payment_details->email, // user email
                'name' => $payment_details->name, // user name
                'payment_type' => 'order', // which kind of payment your are receiving
                'ipn_url' => route('frontend.marcadopago.ipn')
            ]);

            return $redirect_url;
        }

        elseif ($request->payment_gateway == 'manual_payment') {
            $order = Order::where('id', $request->order_id)->first();
            $order->status = 'pending';
            $order->save();
            PaymentLogs::where('order_id', $request->order_id)->update(['transaction_id' => $request->transaction_id]);
            $order_id = Str::random(6) . $request->order_id . Str::random(6);
            return redirect()->route('frontend.order.payment.success', $order_id);
        }

        return redirect()->route('homepage');
    }

    public function paypal_ipn(Request $request)
    {
        $payment_data = XgPaymentGateway::paypal()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id'] . Str::random(6);
            return redirect()->route('frontend.order.payment.success',$order_id);
        }
        return $this->cancel_page();
    }


    public function razorpay_ipn(Request $request)
    {
        $payment_data = XgPaymentGateway::razorpay()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id'] . Str::random(6);
            return redirect()->route('frontend.order.payment.success',$order_id);
        }
        return $this->cancel_page();
    }

    public function paytm_ipn(Request $request)
    {
        $payment_data = XgPaymentGateway::paytm()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id'] . Str::random(6);
            return redirect()->route('frontend.order.payment.success',$order_id);
        }
        return $this->cancel_page();
    }

    public function mollie_ipn()
    {
        $payment_data = XgPaymentGateway::mollie()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id']. Str::random(6);
            return redirect()->route('frontend.order.payment.success',$order_id);
        }
        return self::cancel_page();
    }

    public function stripe_ipn(Request $request){
        $payment_data = XgPaymentGateway::stripe()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id']. Str::random(6);
            return redirect()->route('frontend.order.payment.success',$order_id);
        }
        return $this->cancel_page();
    }



    public function flutterwave_ipn(Request $request)
    {
        $payment_data = XgPaymentGateway::flutterwave()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id']. Str::random(6);
            return redirect()->route('frontend.order.payment.success',$order_id);
        }
        return $this->cancel_page();
    }


    public function paystack_ipn(Request $request)
    {
        $payment_data = XgPaymentGateway::paystack()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id']. Str::random(6);
            return redirect()->route('frontend.order.payment.success',$order_id);
        }
        return $this->cancel_page();
    }

    public function midtrans_ipn()
    {
        $payment_data = XgPaymentGateway::midtrans()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id']. Str::random(6);
            return redirect()->route('frontend.order.payment.success',$order_id);
        }
        return $this->cancel_page();
    }

    public function payfast_ipn()
    {
        $payment_data = XgPaymentGateway::payfast()->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id']. Str::random(6);
            return redirect()->route('frontend.order.payment.success',$order_id);
        }
        return $this->cancel_page();
    }

    public function cashfree_ipn(Request $request)
    {
        $payment_data = XgPaymentGateway::cashfree()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id']. Str::random(6);
            return redirect()->route('frontend.order.payment.success',$order_id);
        }
        return $this->cancel_page();

    }

    public function instamojo_ipn(Request $request)
    {
        $payment_data = XgPaymentGateway::instamojo()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id']. Str::random(6);
            return redirect()->route('frontend.order.payment.success',$order_id);
        }
        return $this->cancel_page();
    }


    public function marcadopago_ipn(Request $request)
    {
        $payment_data = XgPaymentGateway::marcadopago()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id']. Str::random(6);
            return redirect()->route('frontend.order.payment.success',$order_id);
        }
        return $this->cancel_page();
    }


    public function update_data_and_mail_donation($payment_data){
                $payment_log_details = DonationLogs::where('track',$payment_data['track'])->first();
                //update event attendance status

                $payment_log_details->transaction_id = $payment_data['transaction_id'];
                $payment_log_details->status = 'complete';
                $payment_log_details->save();

                //update donation raised amount
                $event_details = Donation::find($payment_log_details->donation_id);
                $event_details->raised = (int)$event_details->raised + (int)$payment_log_details->amount;
                $event_details->save();

                $donation_details = DonationLogs::find($payment_log_details->id);
                Mail::to(get_static_option('site_global_email'))->send(new DonationMessage($donation_details,__('You have a new donation payment from '.get_static_option('site_'.get_default_language().'_title')),'owner'));
                Mail::to(get_static_option('donation_notify_mail'))->send(new DonationMessage($donation_details,__('You donation payment success for '.get_static_option('site_'.get_default_language().'_title')),'customer'));

                return redirect()->route('frontend.donation.payment.success',Str::random(6).$payment_log_details->id.Str::random(6));
    }
    public function update_data_and_mail_gig($payment_data)
    {
        GigOrder::where('payment_track', $payment_data['track'])->update([
            'transaction_id' => $payment_data['transaction_id'],
            'payment_status' => 'complete'
        ]);

        $product_order_details = GigOrder::where('payment_track', $payment_data['track'])->first();
        $default_lang = get_default_language();
        Mail::to($product_order_details->email)->send(new \App\Mail\GigOrder($product_order_details, 'customer', __('Your order has been placed in ') . get_static_option('site_' . $default_lang . '_title')));
        Mail::to(get_static_option('site_global_email'))->send(new \App\Mail\GigOrder($product_order_details, 'owner', __('Your have a new gig order in ') . get_static_option('site_' . $default_lang . '_title')));
        $order_id = Str::random(6) . $product_order_details->id . Str::random(6);
        return redirect()->route('frontend.gig.order.payment.success', $order_id);
    }

    public function update_data_and_mail_event($payment_data)
    {
        $payment_log_details = EventPaymentLogs::where('track',$payment_data['track'])->first();
        $order_details = EventAttendance::findOrFail($payment_log_details->attendance_id);
        //update event attendance status
        $order_details->payment_status = 'complete';
        $order_details->status = 'complete';
        $order_details->save();
        //update event payment log
        $payment_log_details->transaction_id = $payment_data['transaction_id'];
        $payment_log_details->status = 'complete';
        $payment_log_details->save();

        //update event available tickets
        $event_details = Events::find($order_details->event_id);
        $event_details->available_tickets = (int)$event_details->available_tickets - $order_details->quantity;
        $event_details->save();

        //send mail to user
        try {
            Mail::to($payment_log_details->email)->send(New PaymentSuccess($payment_log_details,'event'));
        }catch (\Exception $e){
            return redirect()->back()->with(['msg'=> $e->getMessage(), 'type' => 'error']);
        }
        return redirect()->route('frontend.event.payment.success',Str::random(6).$payment_log_details->attendance_id.Str::random(6));
    }

    public function update_data_and_mail_product($payment_data)
    {
        ProductOrder::where('payment_track', $payment_data['track'])->update([
            'transaction_id' => $payment_data['transaction_id'],
            'payment_status' => 'complete'
        ]);

        rest_cart_session();
        $default_lang = get_default_language();
        $site_title = get_static_option('site_'.$default_lang.'_title');
        $product_order_details =  ProductOrder::where('payment_track', $payment_data['track'])->first();

        try {

            Mail::to(get_static_option('site_global_email'))->send(new \App\Mail\ProductOrder($product_order_details,'owner',__('You Have A New Product Order From ').$site_title));
            Mail::to($product_order_details->billing_email)->send(new \App\Mail\ProductOrder($product_order_details,'customer',__('You order has been placed in ').$site_title));

        }catch (\Exception $e){
            return redirect()->back(['msg'=> $e->getMessage(), 'type'=> 'error']);
        }


        return redirect()->route('frontend.product.payment.success',Str::random(6).$product_order_details->id.Str::random(6));
    }

    public function send_order_mail($order_id)
    {
        $order_details = Order::find($order_id);
        $package_details = PricePlan::where('id', $order_details->package_id)->first();
        $all_fields = unserialize($order_details->custom_fields,['class'=> false]);
        unset($all_fields['package']);

        $all_attachment = unserialize($order_details->attachment,['class'=> false]);
        $order_mail = get_static_option('order_page_form_mail') ? get_static_option('order_page_form_mail') : get_static_option('site_global_email');

        try {
            Mail::to($order_mail)->send(new PlaceOrder($all_fields, $all_attachment, $package_details));
        }catch(\Exception $e){
            return redirect()->back()->with(['msg'=> $e->getMessage(), 'type'=> 'error']);
        }

    }

    private function update_database($order_id, $transaction_id)
    {
        Order::where('id', $order_id)->update(['payment_status' => 'complete']);
        PaymentLogs::where('order_id', $order_id)->update([
            'transaction_id' => $transaction_id,
            'status' => 'complete'
        ]);

    }

}
