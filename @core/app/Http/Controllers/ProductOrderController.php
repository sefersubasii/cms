<?php

namespace App\Http\Controllers;

use App\Donation;
use App\DonationLogs;
use App\EventAttendance;
use App\EventPaymentLogs;
use App\Events;
use App\GigOrder;
use App\Mail\PaymentSuccess;
use App\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use KingFlamez\Rave\Facades\Rave;
use Razorpay\Api\Api;
use Stripe\Charge;
use Mollie\Laravel\Facades\Mollie;
use Stripe\Stripe;
use Unicodeveloper\Paystack\Facades\Paystack;
use Xgenious\Paymentgateway\Facades\XgPaymentGateway;

class ProductOrderController extends Controller
{

    protected function cancel_page(){
        return redirect()->route('frontend.order.payment.cancel.static');
    }

    public function product_checkout(Request $request){
        $this->validate($request,[
            'payment_gateway' => 'nullable|string',
            'subtotal' => 'required|string',
            'coupon_discount' => 'nullable|string',
            'shipping_cost' => 'nullable|string',
            'product_shippings_id' => 'nullable|string',
            'total' => 'required|string',
            'billing_name' => 'required|string',
            'billing_email' => 'required|string',
            'billing_phone' => 'required|string',
            'billing_country' => 'required|string',
            'billing_street_address' => 'required|string',
            'billing_town' => 'required|string',
            'billing_district' => 'required|string',
            'different_shipping_address' => 'nullable|string',
            'shipping_name' => 'nullable|string',
            'shipping_email' => 'nullable|string',
            'shipping_phone' => 'nullable|string',
            'shipping_country' => 'nullable|string',
            'shipping_street_address' => 'nullable|string',
            'shipping_town' => 'nullable|string',
            'shipping_district' => 'nullable|string'
        ],
        [
            'billing_name.required' => __('The billing name field is required.'),
            'billing_email.required' => __('The billing email field is required.'),
            'billing_phone.required' => __('The billing phone field is required.'),
            'billing_country.required' => __('The billing country field is required.'),
            'billing_street_address.required' => __('The billing street address field is required.'),
            'billing_town.required' => __('The billing town field is required.'),
            'billing_district.required' => __('The billing district field is required.')
        ]);
            $order_details = ProductOrder::find($request->order_id);
            if (empty($order_details)){
                $order_details = ProductOrder::create([
                    'payment_gateway' => $request->selected_payment_gateway,
                    'payment_status' => 'pending',
                    'payment_track' => Str::random(10). Str::random(10),
                    'user_id' => auth()->check() ? auth()->user()->id : null,
                    'subtotal' => $request->subtotal,
                    'coupon_discount' => $request->coupon_discount,
                    'coupon_code' => session()->get('coupon_discount'),
                    'shipping_cost' => $request->shipping_cost,
                    'product_shippings_id' => $request->product_shippings_id,
                    'total' => $request->total,
                    'billing_name'  => $request->billing_name,
                    'billing_email'  => $request->billing_email,
                    'billing_phone'  => $request->billing_phone,
                    'billing_country' => $request->billing_country,
                    'billing_street_address' => $request->billing_street_address,
                    'billing_town' => $request->billing_town,
                    'billing_district' => $request->billing_district,
                    'different_shipping_address' => $request->different_shipping_address ? 'yes' : 'no',
                    'shipping_name' => $request->shipping_name,
                    'shipping_email' => $request->shipping_email,
                    'shipping_phone' => $request->shipping_phone,
                    'shipping_country' => $request->shipping_country,
                    'shipping_street_address' => $request->shipping_street_address,
                    'shipping_town' => $request->shipping_town,
                    'shipping_district' => $request->shipping_district,
                    'cart_items' => !empty(session()->get('cart_item')) ? serialize(session()->get('cart_item')) : '',
                    'status' =>  'pending',
                ]);
            }

        if (empty(get_static_option('site_payment_gateway'))){
            rest_cart_session();
            return redirect()->route('frontend.product.payment.success',Str::random(6).$order_details->id.Str::random(6));
        }

        //have to work on below code
        if ($request->selected_payment_gateway === 'cash_on_delivery'){
            $this->send_order_mail($order_details->id);
            rest_cart_session();

            return redirect()->route('frontend.product.payment.success',Str::random(6).$order_details->id.Str::random(6));

        }elseif ($request->selected_payment_gateway === 'paypal'){

            $redirect_url = XgPaymentGateway::paypal()->charge_customer([
                'amount' => $order_details->total,
                'title' => 'Payment For Product Order Id: #'.$order_details->id,
                'description' =>'Payment For Product Order Id: #'.$order_details->id.' Payer Name: '.$order_details->billing_name.' Payer Email:'.$order_details->billing_email,
                'order_id' => $order_details->id,
                'track' => $order_details->payment_track,
                'cancel_url' => route('frontend.product.payment.cancel',$order_details->id),
                'success_url' => route('frontend.product.payment.success', $order_details->id),
                'email' => $order_details->billing_email, // user email
                'name' => $order_details->billing_name, // user name
                'payment_type' => 'product', // which kind of payment your are receiving
                'ipn_url' => route('frontend.product.paypal.ipn'),
            ]);

            session()->put('product_id',$order_details->id);
            return redirect()->away($redirect_url);

        }elseif ($request->selected_payment_gateway === 'paytm'){

            $redirect_url = XgPaymentGateway::paytm()->charge_customer([
                'amount' => $order_details->total,
                'title' => $order_details->id,
                'description' =>'Payment For Product Order Id: #'.$order_details->id.' Payer Name: '.$order_details->billing_name.' Payer Email:'.$order_details->billing_email,
                'order_id' => $order_details->id,
                'track' => $order_details->payment_track,
                'cancel_url' => route('frontend.product.payment.cancel',$order_details->id),
                'success_url' => route('frontend.product.payment.success', $order_details->id),
                'email' => $order_details->billing_email, // user email
                'name' => $order_details->billing_name, // user name
                'payment_type' => 'product', // which kind of payment your are receiving
                'ipn_url' => route('frontend.product.paytm.ipn')
            ]);

            return $redirect_url;

        }elseif ($request->selected_payment_gateway === 'manual_payment'){
           
             $this->validate($request,[
               'transaction_id_val' => 'required'
            ],[
                'transaction_id_val.required' => __('Transaction ID is required')
            ]);

            $order_details->transaction_id = $request->transaction_id_val;
            $order_details->save();

            $this->send_order_mail($order_details->id);
            rest_cart_session();
            return redirect()->route('frontend.product.payment.success',Str::random(6).$order_details->id.Str::random(6));

        }elseif ($request->selected_payment_gateway === 'stripe'){

            $redirect_url = XgPaymentGateway::stripe()->charge_customer([
                'amount' => $order_details->total,
                'title' => $order_details->id,
                'description' =>'Payment For Product Order Id: #'.$order_details->id.' Payer Name: '.$order_details->billing_name.' Payer Email:'.$order_details->billing_email,
                'order_id' => $order_details->id,
                'track' => $order_details->payment_track,
                'cancel_url' => route('frontend.product.payment.cancel',$order_details->id),
                'success_url' => route('frontend.product.payment.success', $order_details->id),
                'email' => $order_details->billing_email, // user email
                'name' => $order_details->billing_name, // user name
                'payment_type' => 'product', // which kind of payment your are receiving
                'ipn_url' => route('frontend.product.stripe.ipn')
            ]);

            return $redirect_url;
        }
        elseif ($request->selected_payment_gateway === 'razorpay'){

            $redirect_url = XgPaymentGateway::razorpay()->charge_customer([
                'amount' => $order_details->total,
                'title' => $order_details->id,
                'description' =>'Payment For Product Order Id: #'.$order_details->id.' Payer Name: '.$order_details->billing_name.' Payer Email:'.$order_details->billing_email,
                'order_id' => $order_details->id,
                'track' => $order_details->payment_track,
                'cancel_url' => route('frontend.product.payment.cancel',$order_details->id),
                'success_url' => route('frontend.product.payment.success', $order_details->id),
                'email' => $order_details->billing_email, // user email
                'name' => $order_details->billing_name, // user name
                'payment_type' => 'product', // which kind of payment your are receiving
                'ipn_url' => route('frontend.product.razorpay.ipn')
            ]);

            return $redirect_url;
        }
        elseif ($request->selected_payment_gateway === 'paystack'){

            $redirect_url = XgPaymentGateway::paystack()->charge_customer([
                'amount' => $order_details->total,
                'title' => $order_details->id,
                'description' =>'Payment For Product Order Id: #'.$order_details->id.' Payer Name: '.$order_details->billing_name.' Payer Email:'.$order_details->billing_email,
                'order_id' => $order_details->id,
                'track' => $order_details->payment_track,
                'cancel_url' => route('frontend.product.payment.cancel',$order_details->id),
                'success_url' => route('frontend.product.payment.success', $order_details->id),
                'email' => $order_details->billing_email, // user email
                'name' => $order_details->billing_name, // user name
                'payment_type' => 'product', // which kind of payment your are receiving
                'ipn_url' => route('frontend.product.paystack.ipn')
            ]);

            return $redirect_url;

        }
        elseif ($request->selected_payment_gateway === 'mollie'){

            $redirect_url = XgPaymentGateway::mollie()->charge_customer([
                'amount' => $order_details->total,
                'title' => $order_details->id,
                'description' =>'Payment For Product Order Id: #'.$order_details->id.' Payer Name: '.$order_details->billing_name.' Payer Email:'.$order_details->billing_email,
                'order_id' => $order_details->id,
                'track' => $order_details->payment_track,
                'cancel_url' => route('frontend.donation.payment.cancel',$order_details->id),
                'success_url' => route('frontend.donation.payment.success', $order_details->id),
                'email' => $order_details->billing_email, // user email
                'name' => $order_details->billing_name, // user name
                'payment_type' => 'product', // which kind of payment your are receiving
                'ipn_url' => route('frontend.product.mollie.ipn')
            ]);

            return $redirect_url;

        }
        elseif ($request->selected_payment_gateway === 'flutterwave'){

            $redirect_url = XgPaymentGateway::flutterwave()->charge_customer([
                'amount' => $order_details->total,
                'title' => $order_details->id,
                'description' =>'Payment For Product Order Id: #'.$order_details->id.' Payer Name: '.$order_details->billing_name.' Payer Email:'.$order_details->billing_email,
                'order_id' => $order_details->id,
                'track' => $order_details->payment_track,
                'cancel_url' => route('frontend.product.payment.cancel',$order_details->id),
                'success_url' => route('frontend.product.payment.success', $order_details->id),
                'email' => $order_details->billing_email, // user email
                'name' => $order_details->billing_name, // user name
                'payment_type' => 'product', // which kind of payment your are receiving
                'ipn_url' => route('frontend.product.flutterwave.ipn')
            ]);

            return $redirect_url;

        }

        elseif ($request->selected_payment_gateway === 'midtrans'){

            $redirect_url = XgPaymentGateway::midtrans()->charge_customer([
                'amount' => $order_details->total,
                'title' => $order_details->id,
                'description' =>'Payment For Product Order Id: #'.$order_details->id.' Payer Name: '.$order_details->billing_name.' Payer Email:'.$order_details->billing_email,
                'order_id' => $order_details->id,
                'track' => $order_details->payment_track,
                'cancel_url' => route('frontend.product.payment.cancel',$order_details->id),
                'success_url' => route('frontend.product.payment.success', $order_details->id),
                'email' => $order_details->billing_email, // user email
                'name' => $order_details->billing_name, // user name
                'payment_type' => 'product', // which kind of payment your are receiving
                'ipn_url' => route('frontend.product.midtrans.ipn')
            ]);

            return $redirect_url;

        }

        elseif ($request->selected_payment_gateway === 'payfast'){

            $redirect_url = XgPaymentGateway::payfast()->charge_customer([
                'amount' => $order_details->total,
                'title' => $order_details->id,
                'description' =>'Payment For Product Order Id: #'.$order_details->id.' Payer Name: '.$order_details->billing_name.' Payer Email:'.$order_details->billing_email,
                'order_id' => $order_details->id,
                'track' => $order_details->payment_track,
                'cancel_url' => route('frontend.product.payment.cancel',$order_details->id),
                'success_url' => route('frontend.product.payment.success', $order_details->id),
                'email' => $order_details->billing_email, // user email
                'name' => $order_details->billing_name, // user name
                'payment_type' => 'product', // which kind of payment your are receiving
                'ipn_url' => route('frontend.product.payfast.ipn')
            ]);

            return $redirect_url;

        }

        elseif ($request->selected_payment_gateway === 'cashfree'){

            $redirect_url = XgPaymentGateway::cashfree()->charge_customer([
                'amount' => $order_details->total,
                'title' => $order_details->id,
                'description' =>'Payment For Product Order Id: #'.$order_details->id.' Payer Name: '.$order_details->billing_name.' Payer Email:'.$order_details->billing_email,
                'order_id' => $order_details->id,
                'track' => $order_details->payment_track,
                'cancel_url' => route('frontend.product.payment.cancel',$order_details->id),
                'success_url' => route('frontend.product.payment.success', $order_details->id),
                'email' => $order_details->billing_email, // user email
                'name' => $order_details->billing_name, // user name
                'payment_type' => 'product', // which kind of payment your are receiving
                'ipn_url' => route('frontend.product.cashfree.ipn')
            ]);

            return $redirect_url;

        }

        elseif ($request->selected_payment_gateway === 'instamojo'){

            $redirect_url = XgPaymentGateway::instamojo()->charge_customer([
                'amount' => $order_details->total,
                'title' => $order_details->id,
                'description' =>'Payment For Product Order Id: #'.$order_details->id.' Payer Name: '.$order_details->billing_name.' Payer Email:'.$order_details->billing_email,
                'order_id' => $order_details->id,
                'track' => $order_details->payment_track,
                'cancel_url' => route('frontend.product.payment.cancel',$order_details->id),
                'success_url' => route('frontend.product.payment.success', $order_details->id),
                'email' => $order_details->billing_email, // user email
                'name' => $order_details->billing_name, // user name
                'payment_type' => 'product', // which kind of payment your are receiving
                'ipn_url' => route('frontend.product.instamojo.ipn')
            ]);
            return $redirect_url;
        }

        elseif ($request->selected_payment_gateway === 'marcadopago'){

            $redirect_url = XgPaymentGateway::marcadopago()->charge_customer([
                'amount' => $order_details->total,
                'title' => $order_details->id,
                'description' =>'Payment For Product Order Id: #'.$order_details->id.' Payer Name: '.$order_details->billing_name.' Payer Email:'.$order_details->billing_email,
                'order_id' => $order_details->id,
                'track' => $order_details->payment_track,
                'cancel_url' => route('frontend.product.payment.cancel',$order_details->id),
                'success_url' => route('frontend.product.payment.success', $order_details->id),
                'email' => $order_details->billing_email, // user email
                'name' => $order_details->billing_name, // user name
                'payment_type' => 'product', // which kind of payment your are receiving
                'ipn_url' => route('frontend.product.marcadopago.ipn')
            ]);
            return $redirect_url;
        }

        return redirect()->route('homepage');
    }
    public function flutterwave_pay(Request $request){
        Rave::initialize(route('frontend.product.flutterwave.callback'));
    }

    public function flutterwave_ipn(Request $request)
    {
        $payment_data = XgPaymentGateway::flutterwave()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id'] . Str::random(6);
            return redirect()->route('frontend.product.payment.success',$order_id);
        }
        return self::cancel_page();
    }

    public function mollie_ipn(Request $request)
    {
        $payment_data = XgPaymentGateway::mollie()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id'] . Str::random(6);
            return redirect()->route('frontend.product.payment.success',$order_id);
        }
        return self::cancel_page();
    }


    public function paypal_ipn(Request $request)
    {
        $payment_data = XgPaymentGateway::paypal()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id'] . Str::random(6);
            return redirect()->route('frontend.product.payment.success',$order_id);
        }
        return self::cancel_page();
    }

    public function paytm_ipn(Request $request)
    {
        $payment_data = XgPaymentGateway::paytm()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id'] . Str::random(6);
            return redirect()->route('frontend.product.payment.success',$order_id);
        }
        return self::cancel_page();
    }

    public function stripe_ipn(Request $request)
    {
        $payment_data = XgPaymentGateway::stripe()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id'] . Str::random(6);
            return redirect()->route('frontend.product.payment.success',$order_id);
        }
        return self::cancel_page();
    }


    public function razorpay_ipn(Request $request){

        $payment_data = XgPaymentGateway::razorpay()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id'] . Str::random(6);
            return redirect()->route('frontend.product.payment.success',$order_id);
        }
        return self::cancel_page();
    }


    public function paystack_ipn(Request $request){

        $payment_data = XgPaymentGateway::paystack()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id'] . Str::random(6);
            return redirect()->route('frontend.product.payment.success',$order_id);
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
            return redirect()->route('frontend.product.payment.success',$order_id);
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
            return redirect()->route('frontend.product.payment.success',$order_id);
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
            return redirect()->route('frontend.product.payment.success',$order_id);
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
            return redirect()->route('frontend.product.payment.success',$order_id);
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
            return redirect()->route('frontend.product.payment.success',$order_id);
        }
        return $this->cancel_page();
    }


    public function update_database($product_id,$transaction_id){
        ProductOrder::where( 'id', $product_id )->update([
            'payment_status' => 'complete',
            'transaction_id' => $transaction_id
        ]);
        rest_cart_session();
    }

    public function send_order_mail($product_id){

        $order_details = ProductOrder::findOrFail($product_id);
        try {
            Mail::to(get_static_option('site_global_email'))->send(new \App\Mail\ProductOrder($order_details,'owner',__('You Have A New Product Order From ').get_static_option('site_'.get_default_language().'_title')));
            Mail::to($order_details->billing_email)->send(new \App\Mail\ProductOrder($order_details,'customer',__('You order has been placed in ').get_static_option('site_'.get_default_language().'_title')));
        }catch (\Exception $e){
            return redirect()->back(['msg'=> $e->getMessage(), 'type'=> 'error']);
        }

    }

}
