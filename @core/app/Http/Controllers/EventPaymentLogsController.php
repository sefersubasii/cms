<?php

namespace App\Http\Controllers;

use App\Donation;
use App\DonationLogs;
use App\EventAttendance;
use App\EventPaymentLogs;
use App\Events;
use App\GigOrder;
use App\Mail\ContactMessage;
use App\Mail\PaymentSuccess;
use App\Order;
use App\PaymentLogs;
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

class EventPaymentLogsController extends Controller
{

    protected function cancel_page(){
        return redirect()->route('frontend.order.payment.cancel.static');
    }

    public function booking_payment_form(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'attendance_id' => 'required|string',
            'payment_gateway' => 'required|string',
        ],
        [
            'name.required' => __('Name field is required'),
            'email.required' => __('Email field is required')
        ]);


        $event_details = EventAttendance::find($request->attendance_id);
        $event_payment_details = EventPaymentLogs::where('attendance_id',$request->attendance_id)->first();
        if (empty($event_payment_details)){
            $payment_log_id = EventPaymentLogs::create([
                'email' =>  $request->email,
                'name' =>  $request->name,
                'event_name' =>  $event_details->event_name,
                'event_cost' =>  ($event_details->event_cost * $event_details->quantity),
                'package_gateway' =>  $request->payment_gateway,
                'attendance_id' =>  $request->attendance_id,
                'status' =>  'pending',
                'track' =>  Str::random(10). Str::random(10),
            ])->id;
            $event_payment_details = EventPaymentLogs::find($payment_log_id);
        }

        //have to work on below code
        if ($request->payment_gateway === 'paypal'){

            $redirect_url = XgPaymentGateway::paypal()->charge_customer([
                'amount' => $event_details->event_cost * $event_details->quantity,
                'title' => 'Payment For Event Order Id: #'.$event_details->event_name,
                'description' => 'Payment For Event Attendance Id: #'.$event_details->id.' Payer Name: '.$event_payment_details->name.' Payer Email:'.$event_payment_details->email,
                'order_id' => $event_details->id,
                'track' => $event_details->track,
                'cancel_url' => route('frontend.event.payment.cancel',$event_details->id),
                'success_url' => route('frontend.event.payment.success', $event_details->id),
                'email' => $event_payment_details->email, // user email
                'name' => $event_payment_details->name, // user name
                'payment_type' => 'event', // which kind of payment your are receiving
                'ipn_url' => route('frontend.event.paypal.ipn'),
            ]);

            session()->put('attendance_id',$event_details->id);
            return redirect()->away($redirect_url);
            

        }elseif ($request->payment_gateway === 'paytm'){

            $redirect_url = XgPaymentGateway::paytm()->charge_customer([
                'amount' => $event_details->event_cost * $event_details->quantity,
                'title' => 'Payment For Event Order Id: #'.$event_details->event_name,
                'description' => 'Payment For Event Attendance Id: #'.$event_details->id.' Payer Name: '.$event_payment_details->name.' Payer Email:'.$event_payment_details->email,
                'order_id' => $event_details->id,
                'track' => $event_details->track,
                'cancel_url' => route('frontend.event.payment.cancel',$event_details->id),
                'success_url' => route('frontend.event.payment.success', $event_details->id),
                'email' => $event_payment_details->email, // user email
                'name' => $event_payment_details->name, // user name
                'payment_type' => 'event', // which kind of payment your are receiving
                'ipn_url' => route('frontend.event.paytm.ipn'),
            ]);

            return $redirect_url;

        }elseif ($request->payment_gateway === 'manual_payment'){
            $order = EventAttendance::where( 'id', $request->attendance_id )->first();
            $order->status = 'pending';
            $order->save();
            EventPaymentLogs::where('attendance_id',$request->attendance_id)->update(['transaction_id' => $request->transaction_id]);
            $this->send_order_mail($request->attendance_id);
            return redirect()->route('frontend.event.payment.success',Str::random(6).$event_payment_details->attendance_id.Str::random(6));

        }elseif ($request->payment_gateway === 'stripe'){
            $redirect_url = XgPaymentGateway::stripe()->charge_customer([
                'amount' => $event_details->event_cost * $event_details->quantity,
                'title' => 'Payment For Event Order Id: #'.$event_details->event_name,
                'description' => 'Payment For Event Attendance Id: #'.$event_details->id.' Payer Name: '.$event_payment_details->name.' Payer Email:'.$event_payment_details->email,
                'order_id' => $event_details->id,
                'track' => $event_details->track,
                'cancel_url' => route('frontend.event.payment.cancel',$event_details->id),
                'success_url' => route('frontend.event.payment.success', $event_details->id),
                'email' => $event_payment_details->email, // user email
                'name' => $event_payment_details->name, // user name
                'payment_type' => 'event', // which kind of payment your are receiving
                'ipn_url' => route('frontend.event.stripe.ipn'),
            ]);

            return $redirect_url;
        }
        elseif ($request->payment_gateway === 'razorpay'){

            $redirect_url = XgPaymentGateway::razorpay()->charge_customer([
                'amount' => $event_details->event_cost * $event_details->quantity,
                'title' => 'Payment For Event Order Id: #'.$event_details->event_name,
                'description' => 'Payment For Event Attendance Id: #'.$event_details->id.' Payer Name: '.$event_payment_details->name.' Payer Email:'.$event_payment_details->email,
                'order_id' => $event_details->id,
                'track' => $event_details->track,
                'cancel_url' => route('frontend.event.payment.cancel',$event_details->id),
                'success_url' => route('frontend.event.payment.success', $event_details->id),
                'email' => $event_payment_details->email, // user email
                'name' => $event_payment_details->name, // user name
                'payment_type' => 'event', // which kind of payment your are receiving
                'ipn_url' => route('frontend.event.razorpay.ipn'),
            ]);

            return $redirect_url;

        }
        elseif ($request->payment_gateway === 'paystack'){

            $redirect_url = XgPaymentGateway::paystack()->charge_customer([
                'amount' => $event_details->event_cost * $event_details->quantity,
                'title' => 'Payment For Event Order Id: #'.$event_details->event_name,
                'description' => 'Payment For Event Attendance Id: #'.$event_details->id.' Payer Name: '.$event_payment_details->name.' Payer Email:'.$event_payment_details->email,
                'order_id' => $event_details->id,
                'track' => $event_details->track,
                'cancel_url' => route('frontend.event.payment.cancel',$event_details->id),
                'success_url' => route('frontend.event.payment.success', $event_details->id),
                'email' => $event_payment_details->email, // user email
                'name' => $event_payment_details->name, // user name
                'payment_type' => 'event', // which kind of payment your are receiving
                'ipn_url' => route('frontend.event.paystack.ipn'),
            ]);

            return $redirect_url;

        }
        elseif ($request->payment_gateway === 'mollie'){

            $redirect_url = XgPaymentGateway::mollie()->charge_customer([
                'amount' => $event_details->event_cost * $event_details->quantity,
                'title' => 'Payment For Event Order Id: #'.$event_details->event_name,
                'description' => 'Payment For Event Attendance Id: #'.$event_details->id.' Payer Name: '.$event_payment_details->name.' Payer Email:'.$event_payment_details->email,
                'order_id' => $event_details->id,
                'track' => $event_details->track,
                'cancel_url' => route('frontend.event.payment.cancel',$event_details->id),
                'success_url' => route('frontend.event.payment.success', $event_details->id),
                'email' => $event_payment_details->email, // user email
                'name' => $event_payment_details->name, // user name
                'payment_type' => 'event', // which kind of payment your are receiving
                'ipn_url' => route('frontend.event.mollie.ipn'),
            ]);

            return $redirect_url;


        }
        elseif ($request->payment_gateway === 'flutterwave'){

            $redirect_url = XgPaymentGateway::flutterwave()->charge_customer([
                'amount' => $event_details->event_cost * $event_details->quantity,
                'title' => 'Payment For Event Order Id: #'.$event_details->event_name,
                'description' => 'Payment For Event Attendance Id: #'.$event_details->id.' Payer Name: '.$event_payment_details->name.' Payer Email:'.$event_payment_details->email,
                'order_id' => $event_details->id,
                'track' => $event_details->track,
                'cancel_url' => route('frontend.event.payment.cancel',$event_details->id),
                'success_url' => route('frontend.event.payment.success', $event_details->id),
                'email' => $event_payment_details->email, // user email
                'name' => $event_payment_details->name, // user name
                'payment_type' => 'event', // which kind of payment your are receiving
                'ipn_url' => route('frontend.event.flutterwave.ipn'),
            ]);

            return $redirect_url;
        }

        elseif ($request->payment_gateway === 'midtrans'){

            $redirect_url = XgPaymentGateway::midtrans()->charge_customer([
                'amount' => $event_details->event_cost * $event_details->quantity,
                'title' => 'Payment For Event Order Id: #'.$event_details->event_name,
                'description' => 'Payment For Event Attendance Id: #'.$event_details->id.' Payer Name: '.$event_payment_details->name.' Payer Email:'.$event_payment_details->email,
                'order_id' => $event_details->id,
                'track' => $event_details->track,
                'cancel_url' => route('frontend.event.payment.cancel',$event_details->id),
                'success_url' => route('frontend.event.payment.success', $event_details->id),
                'email' => $event_payment_details->email, // user email
                'name' => $event_payment_details->name, // user name
                'payment_type' => 'event', // which kind of payment your are receiving
                'ipn_url' => route('frontend.event.midtrans.ipn'),
            ]);

            return $redirect_url;
        }

        elseif ($request->payment_gateway === 'payfast'){

            $redirect_url = XgPaymentGateway::payfast()->charge_customer([
                'amount' => $event_details->event_cost * $event_details->quantity,
                'title' => 'Payment For Event Order Id: #'.$event_details->event_name,
                'description' => 'Payment For Event Attendance Id: #'.$event_details->id.' Payer Name: '.$event_payment_details->name.' Payer Email:'.$event_payment_details->email,
                'order_id' => $event_details->id,
                'track' => $event_details->track,
                'cancel_url' => route('frontend.event.payment.cancel',$event_details->id),
                'success_url' => route('frontend.event.payment.success', $event_details->id),
                'email' => $event_payment_details->email, // user email
                'name' => $event_payment_details->name, // user name
                'payment_type' => 'event', // which kind of payment your are receiving
                'ipn_url' => route('frontend.event.payfast.ipn'),
            ]);

            return $redirect_url;
        }

        elseif ($request->payment_gateway === 'cashfree'){

            $redirect_url = XgPaymentGateway::cashfree()->charge_customer([
                'amount' => $event_details->event_cost * $event_details->quantity,
                'title' => 'Payment For Event Order Id: #'.$event_details->event_name,
                'description' => 'Payment For Event Attendance Id: #'.$event_details->id.' Payer Name: '.$event_payment_details->name.' Payer Email:'.$event_payment_details->email,
                'order_id' => $event_details->id,
                'track' => $event_details->track,
                'cancel_url' => route('frontend.event.payment.cancel',$event_details->id),
                'success_url' => route('frontend.event.payment.success', $event_details->id),
                'email' => $event_payment_details->email, // user email
                'name' => $event_payment_details->name, // user name
                'payment_type' => 'event', // which kind of payment your are receiving
                'ipn_url' => route('frontend.event.cashfree.ipn'),
            ]);

            return $redirect_url;
        }

        elseif ($request->payment_gateway === 'instamojo'){

            $redirect_url = XgPaymentGateway::instamojo()->charge_customer([
                'amount' => $event_details->event_cost * $event_details->quantity,
                'title' => 'Payment For Event Order Id: #'.$event_details->event_name,
                'description' => 'Payment For Event Attendance Id: #'.$event_details->id.' Payer Name: '.$event_payment_details->name.' Payer Email:'.$event_payment_details->email,
                'order_id' => $event_details->id,
                'track' => $event_details->track,
                'cancel_url' => route('frontend.event.payment.cancel',$event_details->id),
                'success_url' => route('frontend.event.payment.success', $event_details->id),
                'email' => $event_payment_details->email, // user email
                'name' => $event_payment_details->name, // user name
                'payment_type' => 'event', // which kind of payment your are receiving
                'ipn_url' => route('frontend.event.instamojo.ipn'),
            ]);

            return $redirect_url;
        }

        elseif ($request->payment_gateway === 'marcadopago'){

            $redirect_url = XgPaymentGateway::marcadopago()->charge_customer([
                'amount' => $event_details->event_cost * $event_details->quantity,
                'title' => 'Payment For Event Order Id: #'.$event_details->event_name,
                'description' => 'Payment For Event Attendance Id: #'.$event_details->id.' Payer Name: '.$event_payment_details->name.' Payer Email:'.$event_payment_details->email,
                'order_id' => $event_details->id,
                'track' => $event_details->track,
                'cancel_url' => route('frontend.event.payment.cancel',$event_details->id),
                'success_url' => route('frontend.event.payment.success', $event_details->id),
                'email' => $event_payment_details->email, // user email
                'name' => $event_payment_details->name, // user name
                'payment_type' => 'event', // which kind of payment your are receiving
                'ipn_url' => route('frontend.event.marcadopago.ipn'),
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
            return redirect()->route('frontend.event.payment.success',$order_id);
        }
        return self::cancel_page();
    }

    public function mollie_ipn(){

        $payment_data = XgPaymentGateway::mollie()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id'] . Str::random(6);
            return redirect()->route('frontend.event.payment.success',$order_id);
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
            return redirect()->route('frontend.event.payment.success',$order_id);
        }
        return self::cancel_page();
    }

    public function paytm_ipn(Request $request){

        $payment_data = XgPaymentGateway::paytm()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id'] . Str::random(6);
            return redirect()->route('frontend.event.payment.success',$order_id);
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
            return redirect()->route('frontend.event.payment.success',$order_id);
        }
        return self::cancel_page();
    }

    public function razorpay_ipn(Request $request){

        $payment_data = XgPaymentGateway::razorpay()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id'] . Str::random(6);
            return redirect()->route('frontend.event.payment.success',$order_id);
        }
        return self::cancel_page();
    }

    public function paystack_ipn(Request $request){
        $payment_data = XgPaymentGateway::paystack()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($payment_data['order_id']);
            $order_id = Str::random(6) . $payment_data['order_id'] . Str::random(6);
            return redirect()->route('frontend.event.payment.success',$order_id);
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
            return redirect()->route('frontend.event.payment.success',$order_id);
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
            return redirect()->route('frontend.event.payment.success',$order_id);
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
            return redirect()->route('frontend.event.payment.success',$order_id);
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
            return redirect()->route('frontend.event.payment.success',$order_id);
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
            return redirect()->route('frontend.event.payment.success',$order_id);
        }
        return $this->cancel_page();
    }

    public function send_order_mail($event_attendance_id){
        $event_attendance = EventAttendance::find($event_attendance_id);
        $fileds_name = unserialize($event_attendance->custom_fields,['class'=>false]);
        $attachment_list = unserialize($event_attendance->attachment,['class'=>false]);

        $order_mail = get_static_option('event_attendance_receiver_mail') ?? get_static_option('site_global_email');

        try {
          Mail::to($order_mail)->send(new ContactMessage($fileds_name, $attachment_list, 'your have an event booking for '.$event_attendance->event_name));
        }catch (\Exception $e){
            return redirect()->back()->with(['msg' => $e->getMessage(),'type' => 'error']);
        }



    }

    private function update_database($attendance_id, $transaction_id)
    {

        //update event attendance
        $event_attendance =  EventAttendance::findOrFail( $attendance_id);
        EventAttendance::where('id', $attendance_id)->update([
            'payment_status' => 'complete',
            'status' => 'complete',
        ]);
        //update event payment log
         EventPaymentLogs::where('attendance_id', $attendance_id)->update([
            'status' => 'complete',
            'transaction_id' => $transaction_id,
        ]);

        //update event available tickets
        $event_details = Events::findOrFail($event_attendance->event_id);
        $event_details->available_tickets = (int) $event_details->available_tickets - $event_attendance->quantity;
        $event_details->save();
    }

}
