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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use KingFlamez\Rave\Facades\Rave;
use Mollie\Laravel\Facades\Mollie;
use phpDocumentor\Reflection\Types\Self_;
use Razorpay\Api\Api;
use Stripe\Charge;
use Stripe\Stripe;
use Unicodeveloper\Paystack\Facades\Paystack;
use Xgenious\Paymentgateway\Facades\XgPaymentGateway;

class DonationLogController extends Controller
{

    protected function cancel_page(){
        return redirect()->route('frontend.order.payment.cancel.static');
    }


    public function store_donation_logs(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'donation_id' => 'required|string',
            'amount' => 'required|string',
            'selected_payment_gateway' => 'required|string',
        ],
        [
            'name.required' => __('Name field is required'),
            'email.required' => __('Email field is required'),
            'amount.required' => __('Amount field is required'),
        ]
        );
        $donation_payment_details = DonationLogs::find($request->order_id);
        if (empty($donation_payment_details)) {
            $donation_payment_details = DonationLogs::create([
                'email' => $request->email,
                'name' => $request->name,
                'donation_id' => $request->donation_id,
                'amount' => $request->amount,
                'donation_type' => $request->donation_type,
                'payment_gateway' => $request->selected_payment_gateway,
                'user_id' => auth()->check() ? auth()->user()->id : '',
                'status' => 'pending',
                'track' => Str::random(10) . Str::random(10),
            ]);
        }


        //have to work on below code
        if ($request->selected_payment_gateway === 'paypal'){

            $redirect_url = XgPaymentGateway::paypal()->charge_customer([
                'amount' => $donation_payment_details->amount,
                'title' =>  __('Payment For Donation:').' '.$donation_payment_details->donation->title ?? '',
                'description' => __('Payment For Donation:').' '.$donation_payment_details->donation->title  ?? ''. ' #'.$donation_payment_details->id,
                'order_id' => 'Payment For Donation Id: #'.$donation_payment_details->id,
                'track' => $donation_payment_details->track,
                'cancel_url' => route('frontend.donation.payment.cancel',$donation_payment_details->id),
                'success_url' => route('frontend.donation.payment.success', $donation_payment_details->id),
                'email' => $donation_payment_details->email, // user email
                'name' => $donation_payment_details->name, // user name
                'payment_type' => 'donation', // which kind of payment your are receiving
                'ipn_url' => route('frontend.donation.paypal.ipn'),
            ]);
            session()->put('order_id',$donation_payment_details->id);
            return redirect()->away($redirect_url);

        }elseif ($request->selected_payment_gateway === 'paytm'){

            $redirect_url = XgPaymentGateway::paytm()->charge_customer([
                'amount' => $donation_payment_details->amount,
                'title' => $donation_payment_details->title ?? '',
                'description' => __('Payment For Donation:').' '.$donation_payment_details->donation->title  ?? ''. ' #'.$donation_payment_details->id ?? '',
                'order_id' => $donation_payment_details->id,
                'track' => $donation_payment_details->track,
                'cancel_url' => route('frontend.donation.payment.cancel',$donation_payment_details->id),
                'success_url' => route('frontend.donation.payment.success', $donation_payment_details->id),
                'email' => $donation_payment_details->email, // user email
                'name' => $donation_payment_details->title, // user name
                'payment_type' => 'donation', // which kind of payment your are receiving
                'ipn_url' => route('frontend.donation.paytm.ipn')
            ]);

            return $redirect_url;

        }elseif ($request->selected_payment_gateway === 'manual_payment'){
            $this->validate($request,[
                'transaction_id' => 'required|string'
            ],
            [
                'transaction_id.required' => __('Transaction ID Required')
            ]);

            DonationLogs::where('donation_id',$request->donation_id)->update(['transaction_id' => $request->transaction_id]);

            return redirect()->route('frontend.donation.payment.success',Str::random(6).$donation_payment_details->id.Str::random(6));

        }elseif ($request->selected_payment_gateway === 'stripe'){

            $redirect_url = XgPaymentGateway::stripe()->charge_customer([
                'amount' => $donation_payment_details->amount,
                'title' => $donation_payment_details->name ?? '',
                'description' => __('Payment For Donation:').' '.optional($donation_payment_details->donation)->title . ' #'.$donation_payment_details->id ?? '',
                'order_id' => $donation_payment_details->id,
                'track' => $donation_payment_details->track,
                'cancel_url' => route('frontend.donation.payment.cancel',$donation_payment_details->id),
                'success_url' => route('frontend.donation.payment.success', $donation_payment_details->id),
                'email' => $donation_payment_details->email, // user email
                'name' => $donation_payment_details->title, // user name
                'payment_type' => 'donation', // which kind of payment your are receiving
                'ipn_url' => route('frontend.donation.stripe.ipn')
            ]);



            return $redirect_url;

        }
        elseif ($request->selected_payment_gateway === 'razorpay'){

            $redirect_url = XgPaymentGateway::razorpay()->charge_customer([
                'amount' => $donation_payment_details->amount,
                'title' => $donation_payment_details->donation->title ?? __('Untitled Donation'),
                'description' => 'Payment For donation Id: #'.$donation_payment_details->id.' Payer Name: '.$donation_payment_details->name.' Payer Email:'.$donation_payment_details->email,
                'order_id' => $donation_payment_details->id,
                'track' => $donation_payment_details->track,
                'cancel_url' => route('frontend.donation.payment.cancel',$donation_payment_details->id),
                'success_url' => route('frontend.donation.payment.success', $donation_payment_details->id),
                'email' => $donation_payment_details->email, // user email
                'name' => $donation_payment_details->name, // user name
                'payment_type' => 'donation', // which kind of payment your are receiving
                'ipn_url' => route('frontend.donation.razorpay.ipn')
            ]);

            return $redirect_url;

        }
        elseif ($request->selected_payment_gateway === 'paystack'){

            $redirect_url = XgPaymentGateway::paystack()->charge_customer([
                'amount' => $donation_payment_details->amount,
                'title' => $donation_payment_details->title,
                'description' =>'Payment For Donation Id: #'.$donation_payment_details->id.' Payer Name: '.$donation_payment_details->name.' Payer Email:'.$donation_payment_details->email,
                'order_id' => $donation_payment_details->id,
                'track' => $donation_payment_details->track,
                'cancel_url' => route('frontend.donation.payment.cancel',$donation_payment_details->id),
                'success_url' => route('frontend.donation.payment.success', $donation_payment_details->id),
                'email' => $donation_payment_details->email, // user email
                'name' => $donation_payment_details->name, // user name
                'payment_type' => 'donation', // which kind of payment your are receiving
                'ipn_url' => route('frontend.donation.paystack.ipn')
            ]);

            return $redirect_url;
        }
        elseif ($request->selected_payment_gateway === 'mollie'){

            $redirect_url = XgPaymentGateway::mollie()->charge_customer([
                'amount' => $donation_payment_details->amount,
                'title' => $donation_payment_details->title,
                'description' =>'Payment For Donation Id: #'.$donation_payment_details->id.' Payer Name: '.$donation_payment_details->name.' Payer Email:'.$donation_payment_details->email,
                'order_id' => $donation_payment_details->id,
                'track' => $donation_payment_details->track,
                'cancel_url' => route('frontend.donation.payment.cancel',$donation_payment_details->id),
                'success_url' => route('frontend.donation.payment.success', $donation_payment_details->id),
                'email' => $donation_payment_details->email, // user email
                'name' => $donation_payment_details->name, // user name
                'payment_type' => 'donation', // which kind of payment your are receiving
                'ipn_url' => route('frontend.donation.mollie.ipn')
            ]);

            return $redirect_url;

        }
        elseif ($request->selected_payment_gateway === 'flutterwave'){

            $redirect_url = XgPaymentGateway::flutterwave()->charge_customer([
                'amount' => $donation_payment_details->amount,
                'title' => $donation_payment_details->title ?? '',
                'description' => __('Payment For Donation:').' '.$donation_payment_details->donation->title  ?? ''. ' #'.$donation_payment_details->id ?? '',
                'order_id' => $donation_payment_details->id,
                'track' => $donation_payment_details->track,
                'cancel_url' => route('frontend.donation.payment.cancel',$donation_payment_details->id),
                'success_url' => route('frontend.donation.payment.success', $donation_payment_details->id),
                'email' => $donation_payment_details->email, // user email
                'name' => $donation_payment_details->name, // user name
                'payment_type' => 'donation', // which kind of payment your are receiving
                'ipn_url' =>route('frontend.donation.flutterwave.ipn')
            ]);

            return $redirect_url;


    } elseif($request->selected_payment_gateway === 'midtrans') {

            $redirect_url = XgPaymentGateway::midtrans()->charge_customer([
                'amount' => $donation_payment_details->amount,
                'title' => $donation_payment_details->title ?? '',
                'description' => __('Payment For Donation:').' '.$donation_payment_details->donation->title  ?? ''. ' #'.$donation_payment_details->id ?? '',
                'order_id' => $donation_payment_details->id,
                'track' => $donation_payment_details->track,
                'cancel_url' => route('frontend.donation.payment.cancel',$donation_payment_details->id),
                'success_url' => route('frontend.donation.payment.success', $donation_payment_details->id),
                'email' => $donation_payment_details->email, // user email
                'name' => $donation_payment_details->name, // user name
                'payment_type' => 'donation', // which kind of payment your are receiving
                'ipn_url' =>route('frontend.donation.midtrans.ipn')
            ]);

            return $redirect_url;

        } elseif ($request->selected_payment_gateway === 'payfast') {

            $redirect_url = XgPaymentGateway::payfast()->charge_customer([
                'amount' => $donation_payment_details->amount,
                'title' => $donation_payment_details->title ?? '',
                'description' => __('Payment For Donation:').' '.$donation_payment_details->donation->title  ?? ''. ' #'.$donation_payment_details->id ?? '',
                'order_id' => $donation_payment_details->id,
                'track' => $donation_payment_details->track,
                'cancel_url' => route('frontend.donation.payment.cancel',$donation_payment_details->id),
                'success_url' => route('frontend.donation.payment.success', $donation_payment_details->id),
                'email' => $donation_payment_details->email, // user email
                'name' => $donation_payment_details->name, // user name
                'payment_type' => 'donation', // which kind of payment your are receiving
                'ipn_url' =>route('frontend.donation.payfast.ipn')
            ]);

            return $redirect_url;

        } elseif ($request->selected_payment_gateway == 'cashfree') {

            $redirect_url = XgPaymentGateway::cashfree()->charge_customer([
                'amount' => $donation_payment_details->amount,
                'title' => $donation_payment_details->title ?? '',
                'description' => __('Payment For Donation:').' '.$donation_payment_details->donation->title  ?? ''. ' #'.$donation_payment_details->id ?? '',
                'order_id' => $donation_payment_details->id,
                'track' => $donation_payment_details->track,
                'cancel_url' => route('frontend.donation.payment.cancel',$donation_payment_details->id),
                'success_url' => route('frontend.donation.payment.success', $donation_payment_details->id),
                'email' => $donation_payment_details->email, // user email
                'name' => $donation_payment_details->name, // user name
                'payment_type' => 'donation', // which kind of payment your are receiving
                'ipn_url' =>route('frontend.donation.cashfree.ipn')
            ]);

            return $redirect_url;

        }

        elseif ($request->selected_payment_gateway == 'instamojo') {

            $redirect_url = XgPaymentGateway::instamojo()->charge_customer([
                'amount' => $donation_payment_details->amount,
                'title' => $donation_payment_details->title ?? '',
                'description' => __('Payment For Donation:') . ' ' . $donation_payment_details->donation->title ?? '' . ' #' . $donation_payment_details->id ?? '',
                'order_id' => $donation_payment_details->id,
                'track' => $donation_payment_details->track,
                'cancel_url' => route('frontend.donation.payment.cancel', $donation_payment_details->id),
                'success_url' => route('frontend.donation.payment.success', $donation_payment_details->id),
                'email' => $donation_payment_details->email, // user email
                'name' => $donation_payment_details->name, // user name
                'payment_type' => 'donation', // which kind of payment your are receiving
                'ipn_url' => route('frontend.donation.instamojo.ipn')
            ]);

            return $redirect_url;
        }


        elseif ($request->selected_payment_gateway == 'marcadopago') {

            $redirect_url = XgPaymentGateway::marcadopago()->charge_customer([
                'amount' => $donation_payment_details->amount,
                'title' => $donation_payment_details->title ?? '',
                'description' => __('Payment For Donation:') . ' ' . $donation_payment_details->donation->title ?? '' . ' #' . $donation_payment_details->id ?? '',
                'order_id' => $donation_payment_details->id,
                'track' => $donation_payment_details->track,
                'cancel_url' => route('frontend.donation.payment.cancel', $donation_payment_details->id),
                'success_url' => route('frontend.donation.payment.success', $donation_payment_details->id),
                'email' => $donation_payment_details->email, // user email
                'name' => $donation_payment_details->name, // user name
                'payment_type' => 'donation', // which kind of payment your are receiving
                'ipn_url' => route('frontend.donation.marcadopago.ipn')
            ]);

            return $redirect_url;
        }


        return redirect()->route('homepage');
    }



    public function flutterwave_ipn(Request $request)
    {
        $payment_data = XgPaymentGateway::flutterwave()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id'] . Str::random(6);
            return redirect()->route('frontend.donation.payment.success',$order_id);
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
            return redirect()->route('frontend.donation.payment.success',$order_id);
        }
        return self::cancel_page();
    }

    public function paytm_ipn(Request $request){

        $payment_data = XgPaymentGateway::paytm()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id']. Str::random(6);
            return redirect()->route('frontend.donation.payment.success',$order_id);
        }
        return self::cancel_page();
    }


     public function stripe_ipn(){
        $payment_data = XgPaymentGateway::stripe()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id']. Str::random(6);
            return redirect()->route('frontend.donation.payment.success',$order_id);
        }
        return $this->cancel_page();
    }


    public function razorpay_ipn(){

        $payment_data = XgPaymentGateway::razorpay()->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id']. Str::random(6);
            return redirect()->route('frontend.donation.payment.success',$order_id);
        }
        return $this->cancel_page();
    }

    public function mollie_ipn(){

        $payment_data = XgPaymentGateway::mollie()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id']. Str::random(6);
            return redirect()->route('frontend.donation.payment.success',$order_id);
        }
        return self::cancel_page();
    }

    public function paystack_ipn(){

        $payment_data = XgPaymentGateway::paystack()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id']. Str::random(6);
            return redirect()->route('frontend.donation.payment.success',$order_id);
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
            return redirect()->route('frontend.donation.payment.success',$order_id);
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
            return redirect()->route('frontend.donation.payment.success',$order_id);
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
            return redirect()->route('frontend.donation.payment.success',$order_id);
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
            return redirect()->route('frontend.donation.payment.success',$order_id);
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
            return redirect()->route('frontend.donation.payment.success',$order_id);
        }
        return $this->cancel_page();
    }

    public function send_order_mail($donation_log_id){
        $donation_details = DonationLogs::find($donation_log_id);

        try {
            Mail::to(get_static_option('site_global_email'))->send(new DonationMessage($donation_details,__('You have a new donation payment from '.get_static_option('site_'.get_default_language().'_title')),'owner'));
            Mail::to(get_static_option('donation_notify_mail'))->send(new DonationMessage($donation_details,__('Your donation payment success for '.get_static_option('site_'.get_default_language().'_title')),'customer'));
        }catch (\Exception $e){
            return redirect()->back()->with(['msg' => $e->getMessage(), 'type' => 'error']);
        }
    }

    private function update_database($donation_id, $transaction_id)
    {
        //donation logs update
        $payment_log_details = DonationLogs::findOrFail($donation_id);
        $payment_log_details->status = 'complete';
        $payment_log_details->transaction_id = $transaction_id;
        $payment_log_details->save();

        //update donation raised amount
        $event_details = Donation::findOrFail($payment_log_details->donation_id);
        $event_details->raised = (int)$event_details->raised + (int)$payment_log_details->amount;
        $event_details->save();

    }

}
