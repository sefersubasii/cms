<?php

namespace App\Http\Controllers;

use App\GigOrder;
use App\Mail\PaymentSuccess;
use App\Order;
use App\PaymentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use KingFlamez\Rave\Facades\Rave;
use Mollie\Laravel\Facades\Mollie;
use Razorpay\Api\Api;
use Stripe\Charge;
use Stripe\Stripe;
use Xgenious\Paymentgateway\Facades\XgPaymentGateway;

class GigOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['paypal_ipn','paytm_ipn']);
    }

    protected function cancel_page(){
        return redirect()->route('frontend.order.payment.cancel.static');
    }

    public function gig_new_order(Request  $request){
        $this->validate($request,[
            'full_name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'message' => 'required',
            'additional_note' => 'nullable',
            'selected_payment_gateway' => 'required|string|max:191',
            'file' => 'nullable|mimes:zip|max:252000',
        ]);

        $payment_track = Str::random(32);
        $payment_gateway = $request->selected_payment_gateway;
        $gig_details = GigOrder::find($request->gig_order_id);
        if (empty($gig_details)){
            $gig_details = GigOrder::create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'message' => $request->message,
                'additional_note' => $request->additional_note,
                'selected_payment_gateway' => $request->selected_payment_gateway,
                'gig_id' => $request->gig_id,
                'selected_plan_index' => $request->selected_plan_index,
                'selected_plan_revisions' => $request->selected_plan_revisions,
                'selected_plan_delivery_days' => $request->selected_plan_delivery_days,
                'selected_plan_price' => $request->selected_plan_price,
                'selected_plan_title' => $request->selected_plan_title,
                'payment_track' => $payment_track,
                'payment_status' => 'pending',
                'order_status' => 'pending',
                'seen' => 0,
                'user_id' => auth()->guard('web')->user()->id,
            ]);
        }

        //add file name to database;
        if ($request->hasFile('file')){
            $file = $request->file('file');
            $file_name = Str::slug($file->getClientOriginalName());
            $file_ext = strtolower($file->getClientOriginalExtension());
            if ($file_ext == 'zip'){
                $db_file_name = 'order-file'.$gig_details->id.$file_name.'.'.$file_ext;
                $file->move('assets/uploads/gig-files',$db_file_name);
                $gig_details->file = $db_file_name;
                $gig_details->save();
            }
        }


        if ($payment_gateway === 'paypal'){

            $redirect_url = XgPaymentGateway::paypal()->charge_customer([
                'amount' => $gig_details->selected_plan_price,
                'title' => 'Payment For Gig Order Id: #'.$gig_details->id,
                'description' =>'Payment For Gig Order Id: #'.$gig_details->id.' Gig Plan Name: '.$gig_details->selected_plan_title.' Payer Name: '.$gig_details->full_name.' Payer Email:'.$gig_details->email,
                'order_id' => $gig_details->id,
                'track' =>  $gig_details->payment_track,
                'cancel_url' => route('frontend.gig.order.payment.cancel',$gig_details->id),
                'success_url' => route('frontend.gig.order.payment.success', $gig_details->id),
                'email' => $gig_details->email, // user email
                'name' => $gig_details->full_name, // user name
                'payment_type' => 'gig', // which kind of payment your are receiving
                'ipn_url' => route('frontend.gig.paypal.ipn'),
            ]);

            session()->put('gig_id',$gig_details->id);
            return redirect()->away($redirect_url);

        }elseif($payment_gateway === 'paytm'){

            $redirect_url = XgPaymentGateway::paytm()->charge_customer([
                'amount' => $gig_details->selected_plan_price,
                'title' => 'Payment For Gig Order Id: #'.$gig_details->id,
                'description' =>'Payment For Gig Order Id: #'.$gig_details->id.' Gig Plan Name: '.$gig_details->selected_plan_title.' Payer Name: '.$gig_details->full_name.' Payer Email:'.$gig_details->email,
                'order_id' => $gig_details->id,
                'track' =>  $gig_details->payment_track,
                'cancel_url' => route('frontend.gig.order.payment.cancel',$gig_details->id),
                'success_url' => route('frontend.gig.order.payment.success', $gig_details->id),
                'email' => $gig_details->email, // user email
                'name' => $gig_details->full_name, // user name
                'payment_type' => 'gig', // which kind of payment your are receiving
                'ipn_url' => route('frontend.gig.paytm.ipn'),
            ]);

            return $redirect_url;

        }elseif($payment_gateway === 'razorpay'){

            $redirect_url = XgPaymentGateway::razorpay()->charge_customer([
                'amount' => $gig_details->selected_plan_price,
                'title' => 'Payment For Gig Order Id: #'.$gig_details->id,
                'description' =>'Payment For Gig Order Id: #'.$gig_details->id.' Gig Plan Name: '.$gig_details->selected_plan_title.' Payer Name: '.$gig_details->full_name.' Payer Email:'.$gig_details->email,
                'order_id' => $gig_details->id,
                'track' =>  $gig_details->payment_track,
                'cancel_url' => route('frontend.gig.order.payment.cancel',$gig_details->id),
                'success_url' => route('frontend.gig.order.payment.success', $gig_details->id),
                'email' => $gig_details->email, // user email
                'name' => $gig_details->full_name, // user name
                'payment_type' => 'gig', // which kind of payment your are receiving
                'ipn_url' => route('frontend.gig.razorpay.ipn'),
            ]);

            return $redirect_url;

        }elseif($payment_gateway === 'stripe'){

            $redirect_url = XgPaymentGateway::stripe()->charge_customer([
                'amount' => $gig_details->selected_plan_price,
                'title' => 'Payment For Gig Order Id: #'.$gig_details->id,
                'description' =>'Payment For Gig Order Id: #'.$gig_details->id.' Gig Plan Name: '.$gig_details->selected_plan_title.' Payer Name: '.$gig_details->full_name.' Payer Email:'.$gig_details->email,
                'order_id' => $gig_details->id,
                'track' =>  $gig_details->payment_track,
                'cancel_url' => route('frontend.gig.order.payment.cancel',$gig_details->id),
                'success_url' => route('frontend.gig.order.payment.success', $gig_details->id),
                'email' => $gig_details->email, // user email
                'name' => $gig_details->full_name, // user name
                'payment_type' => 'gig', // which kind of payment your are receiving
                'ipn_url' => route('frontend.gig.stripe.ipn'),
            ]);

            return $redirect_url;

        }elseif($payment_gateway === 'mollie'){

            $redirect_url = XgPaymentGateway::mollie()->charge_customer([
                'amount' => $gig_details->selected_plan_price,
                'title' => 'Payment For Gig Order Id: #'.$gig_details->id,
                'description' =>'Payment For Gig Order Id: #'.$gig_details->id.' Gig Plan Name: '.$gig_details->selected_plan_title.' Payer Name: '.$gig_details->full_name.' Payer Email:'.$gig_details->email,
                'order_id' => $gig_details->id,
                'track' =>  $gig_details->payment_track,
                'cancel_url' => route('frontend.gig.order.payment.cancel',$gig_details->id),
                'success_url' => route('frontend.gig.order.payment.success', $gig_details->id),
                'email' => $gig_details->email, // user email
                'name' => $gig_details->full_name, // user name
                'payment_type' => 'gig', // which kind of payment your are receiving
                'ipn_url' => route('frontend.gig.mollie.ipn'),
            ]);
            return $redirect_url;

        }elseif($payment_gateway === 'paystack'){
            $redirect_url = XgPaymentGateway::paystack()->charge_customer([
                'amount' => $gig_details->selected_plan_price,
                'title' => 'Payment For Gig Order Id: #'.$gig_details->id,
                'description' =>'Payment For Gig Order Id: #'.$gig_details->id.' Gig Plan Name: '.$gig_details->selected_plan_title.' Payer Name: '.$gig_details->full_name.' Payer Email:'.$gig_details->email,
                'order_id' => $gig_details->id,
                'track' =>  $gig_details->payment_track,
                'cancel_url' => route('frontend.gig.order.payment.cancel',$gig_details->id),
                'success_url' => route('frontend.gig.order.payment.success', $gig_details->id),
                'email' => $gig_details->email, // user email
                'name' => $gig_details->full_name, // user name
                'payment_type' => 'gig', // which kind of payment your are receiving
                'ipn_url' => route('frontend.gig.paystack.ipn'),
            ]);
            return $redirect_url;

        }
        elseif($payment_gateway === 'flutterwave'){

            $redirect_url = XgPaymentGateway::flutterwave()->charge_customer([
                'amount' => $gig_details->selected_plan_price,
                'title' => 'Payment For Gig Order Id: #'.$gig_details->id,
                'description' =>'Payment For Gig Order Id: #'.$gig_details->id.' Gig Plan Name: '.$gig_details->selected_plan_title.' Payer Name: '.$gig_details->full_name.' Payer Email:'.$gig_details->email,
                'order_id' => $gig_details->id,
                'track' =>  $gig_details->payment_track,
                'cancel_url' => route('frontend.gig.order.payment.cancel',$gig_details->id),
                'success_url' => route('frontend.gig.order.payment.success', $gig_details->id),
                'email' => $gig_details->email, // user email
                'name' => $gig_details->full_name, // user name
                'payment_type' => 'gig', // which kind of payment your are receiving
                'ipn_url' => route('frontend.gig.flutterwave.ipn'),
            ]);
            return $redirect_url;
        }

        elseif($payment_gateway === 'midtrans'){

            $redirect_url = XgPaymentGateway::midtrans()->charge_customer([
                'amount' => $gig_details->selected_plan_price,
                'title' => 'Payment For Gig Order Id: #'.$gig_details->id,
                'description' =>'Payment For Gig Order Id: #'.$gig_details->id.' Gig Plan Name: '.$gig_details->selected_plan_title.' Payer Name: '.$gig_details->full_name.' Payer Email:'.$gig_details->email,
                'order_id' => $gig_details->id,
                'track' =>  $gig_details->payment_track,
                'cancel_url' => route('frontend.gig.order.payment.cancel',$gig_details->id),
                'success_url' => route('frontend.gig.order.payment.success', $gig_details->id),
                'email' => $gig_details->email, // user email
                'name' => $gig_details->full_name, // user name
                'payment_type' => 'gig', // which kind of payment your are receiving
                'ipn_url' => route('frontend.gig.midtrans.ipn'),
            ]);
            return $redirect_url;
        }

        elseif($payment_gateway === 'payfast'){

            $redirect_url = XgPaymentGateway::payfast()->charge_customer([
                'amount' => $gig_details->selected_plan_price,
                'title' => 'Payment For Gig Order Id: #'.$gig_details->id,
                'description' =>'Payment For Gig Order Id: #'.$gig_details->id.' Gig Plan Name: '.$gig_details->selected_plan_title.' Payer Name: '.$gig_details->full_name.' Payer Email:'.$gig_details->email,
                'order_id' => $gig_details->id,
                'track' =>  $gig_details->payment_track,
                'cancel_url' => route('frontend.gig.order.payment.cancel',$gig_details->id),
                'success_url' => route('frontend.gig.order.payment.success', $gig_details->id),
                'email' => $gig_details->email, // user email
                'name' => $gig_details->full_name, // user name
                'payment_type' => 'gig', // which kind of payment your are receiving
                'ipn_url' => route('frontend.gig.payfast.ipn'),
            ]);
            return $redirect_url;
        }

        elseif($payment_gateway === 'cashfree'){

            $redirect_url = XgPaymentGateway::cashfree()->charge_customer([
                'amount' => $gig_details->selected_plan_price,
                'title' => 'Payment For Gig Order Id: #'.$gig_details->id,
                'description' =>'Payment For Gig Order Id: #'.$gig_details->id.' Gig Plan Name: '.$gig_details->selected_plan_title.' Payer Name: '.$gig_details->full_name.' Payer Email:'.$gig_details->email,
                'order_id' => $gig_details->id,
                'track' =>  $gig_details->payment_track,
                'cancel_url' => route('frontend.gig.order.payment.cancel',$gig_details->id),
                'success_url' => route('frontend.gig.order.payment.success', $gig_details->id),
                'email' => $gig_details->email, // user email
                'name' => $gig_details->full_name, // user name
                'payment_type' => 'gig', // which kind of payment your are receiving
                'ipn_url' => route('frontend.gig.cashfree.ipn'),
            ]);
            return $redirect_url;
        }

        elseif($payment_gateway === 'instamojo'){

            $redirect_url = XgPaymentGateway::instamojo()->charge_customer([
                'amount' => $gig_details->selected_plan_price,
                'title' => 'Payment For Gig Order Id: #'.$gig_details->id,
                'description' =>'Payment For Gig Order Id: #'.$gig_details->id.' Gig Plan Name: '.$gig_details->selected_plan_title.' Payer Name: '.$gig_details->full_name.' Payer Email:'.$gig_details->email,
                'order_id' => $gig_details->id,
                'track' =>  $gig_details->payment_track,
                'cancel_url' => route('frontend.gig.order.payment.cancel',$gig_details->id),
                'success_url' => route('frontend.gig.order.payment.success', $gig_details->id),
                'email' => $gig_details->email, // user email
                'name' => $gig_details->full_name, // user name
                'payment_type' => 'gig', // which kind of payment your are receiving
                'ipn_url' => route('frontend.gig.instamojo.ipn'),
            ]);
            return $redirect_url;
        }

        elseif($payment_gateway == 'marcadopago'){

            $redirect_url = XgPaymentGateway::marcadopago()->charge_customer([
                'amount' => $gig_details->selected_plan_price,
                'title' => 'Payment For Gig Order Id: #'.$gig_details->id,
                'description' =>'Payment For Gig Order Id: #'.$gig_details->id.' Gig Plan Name: '.$gig_details->selected_plan_title.' Payer Name: '.$gig_details->full_name.' Payer Email:'.$gig_details->email,
                'order_id' => $gig_details->id,
                'track' =>  $gig_details->payment_track,
                'cancel_url' => route('frontend.gig.order.payment.cancel',$gig_details->id),
                'success_url' => route('frontend.gig.order.payment.success', $gig_details->id),
                'email' => $gig_details->email, // user email
                'name' => $gig_details->full_name, // user name
                'payment_type' => 'gig', // which kind of payment your are receiving
                'ipn_url' => route('frontend.gig.marcadopago.ipn')
            ]);

            return $redirect_url;
        }

        elseif($payment_gateway === 'manual_payment'){
            $this->validate($request,[
                'transaction_id' => 'required'
            ],[
                'transaction_id.required' => __('you must have to provide transaction id for verify your payment')
            ]);
            $gig_details->transaction_id = $request->transaction_id;
            $gig_details->save();
            $this->send_order_mail($gig_details->id);
            return redirect()->route('frontend.gig.order.payment.success',Str::random(6).$gig_details->id.Str::random(6));
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
            return redirect()->route('frontend.gig.order.payment.success',$order_id);
        }
        return self::cancel_page();
    }


    public function flutterwave_ipn(Request $request)
    {
        $payment_data = XgPaymentGateway::flutterwave()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id'] . Str::random(6);
            return redirect()->route('frontend.gig.order.payment.success',$order_id);
        }
        return self::cancel_page();
    }

    public function paytm_ipn(Request $request){
        $payment_data = XgPaymentGateway::paytm()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id'] . Str::random(6);
            return redirect()->route('frontend.gig.order.payment.success',$order_id);
        }
        return self::cancel_page();

    }

    public function mollie_ipn(){

        $payment_data = XgPaymentGateway::mollie()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id'] . Str::random(6);
            return redirect()->route('frontend.gig.order.payment.success',$order_id);
        }
        return self::cancel_page();
    }

    public function razorpay_ipn(Request $request){

        $payment_data = XgPaymentGateway::razorpay()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id'] . Str::random(6);
            return redirect()->route('frontend.gig.order.payment.success',$order_id);
        }
        return self::cancel_page();
    }

    public function stripe_ipn(Request $request){
        $payment_data = XgPaymentGateway::stripe()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id'] . Str::random(6);
            return redirect()->route('frontend.gig.order.payment.success',$order_id);
        }
        return self::cancel_page();
    }

    public function midtrans_ipn()
    {
        $payment_data = XgPaymentGateway::midtrans()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id']. Str::random(6);
            return redirect()->route('frontend.gig.order.payment.success',$order_id);
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
            return redirect()->route('frontend.gig.order.payment.success',$order_id);
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
            return redirect()->route('frontend.gig.order.payment.success',$order_id);
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
            return redirect()->route('frontend.gig.order.payment.success',$order_id);
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
            return redirect()->route('frontend.gig.order.payment.success',$order_id);
        }
        return $this->cancel_page();
    }


    public function update_database($order_id,$transaction_id){
        GigOrder::findOrFail($order_id)->update(['transaction_id' => $transaction_id,'payment_status' => 'complete']);
    }
    public function send_order_mail($order_id){
        $gig_details = GigOrder::find($order_id);
        $default_lang = get_default_language();
        $admin_email = !empty(get_static_option('gig_page_notify_email')) ? get_static_option('gig_page_notify_email') : get_static_option('site_global_email');

        try {
            Mail::to($gig_details->email)->send(new \App\Mail\GigOrder($gig_details,'customer',__('Your order has been placed in ').get_static_option('site_'.$default_lang.'_title')));
            Mail::to($admin_email)->send(new \App\Mail\GigOrder($gig_details,'owner',__('Your have a new gig order in ').get_static_option('site_'.$default_lang.'_title')));
        }catch (\Exception $e){
            return redirect()->back()->with(['msg'=> $e->getMessage(), 'type'=>'error']);
        }


    }

}
