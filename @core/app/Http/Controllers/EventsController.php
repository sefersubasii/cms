<?php

namespace App\Http\Controllers;

use App\EventAttendance;
use App\EventPaymentLogs;
use App\Events;
use App\EventsCategory;
use App\JobApplicant;
use App\Jobs;
use App\Language;
use App\Mail\OrderReply;
use App\Mail\PaymentSuccess;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function new_event(){
        $all_languages = Language::all();
        $all_categories = EventsCategory::where(['status' => 'publish','lang' => get_default_language()])->get();
        return view('backend.events.new-event')->with(['all_languages' => $all_languages,'all_categories' => $all_categories]);
    }

    public function store_event(Request $request){
        $this->validate($request,[
            'title' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'category_id' => 'required|string|max:191',
            'event_content' => 'required|string',
            'organizer' => 'nullable|string',
            'organizer_email' => 'nullable|string',
            'organizer_website' => 'nullable|string',
            'organizer_phone' => 'nullable|string',
            'venue' => 'nullable|string',
            'venue_location' => 'nullable|string',
            'venue_phone' => 'nullable|string',
            'time' => 'required|string',
            'image' => 'nullable|string',
            'date' => 'required|string',
            'cost' => 'required|string',
            'available_tickets' => 'required|string',
            'slug' => 'nullable|string'
        ]);

        Events::create([
            'title' => $request->title,
            'slug' => ($request->slug) ? $request->slug : \Str::slug($request->title),
            'content' => $request->event_content,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'lang' => $request->lang,
            'date' => $request->date,
            'time' => $request->time,
            'cost' => $request->cost,
            'available_tickets' => $request->available_tickets,
            'image' => $request->image,
            'organizer' => $request->organizer,
            'organizer_email' => $request->organizer_email,
            'organizer_website' => $request->organizer_website,
            'organizer_phone' => $request->organizer_phone,
            'venue' => $request->venue,
            'venue_location' => $request->venue_location,
            'venue_phone' => $request->venue_phone,
            'meta_description' => $request->meta_description,
            'meta_title' => $request->meta_title,
            'meta_tags' => $request->meta_tags,
        ]);

        return redirect()->back()->with(['msg' => __('New Event Created Success...'),'type'=>'success']);
    }

    public function all_events(){
        $all_events = Events::all()->groupBy('lang');
        return view('backend.events.all-events')->with(['all_events' => $all_events]);
    }

    public function edit_event($id){
        $event = Events::findOrFail($id);
        $all_languages = Language::all();
        $all_categories = EventsCategory::where(['status' => 'publish','lang' => $event->lang])->get();
        return view('backend.events.edit-event')->with(['all_languages' => $all_languages,'all_categories' => $all_categories,'event' => $event]);
    }

    public function delete_event(Request $request,$id){
        Events::findOrFail($id)->delete();
        return redirect()->back()->with(['msg' => __('Event Delete Success...'),'type'=>'danger']);
    }

    public function update_event(Request $request){
        $this->validate($request,[
            'title' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'category_id' => 'required|string|max:191',
            'event_content' => 'required|string',
            'organizer' => 'nullable|string',
            'organizer_email' => 'nullable|string',
            'organizer_website' => 'nullable|string',
            'organizer_phone' => 'nullable|string',
            'venue' => 'nullable|string',
            'venue_location' => 'nullable|string',
            'venue_phone' => 'nullable|string',
            'time' => 'required|string',
            'image' => 'nullable|string',
            'date' => 'required|string',
            'cost' => 'required|string',
            'available_tickets' => 'required|string',
            'slug' => 'nullable|string'
        ]);

        Events::findOrFail($request->event_id)->update([
            'title' => $request->title,
            'slug' => ($request->slug) ? $request->slug : \Str::slug($request->title),
            'content' => $request->event_content,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'lang' => $request->lang,
            'date' => $request->date,
            'time' => $request->time,
            'cost' => $request->cost,
            'available_tickets' => $request->available_tickets,
            'image' => $request->image,
            'organizer' => $request->organizer,
            'organizer_email' => $request->organizer_email,
            'organizer_website' => $request->organizer_website,
            'organizer_phone' => $request->organizer_phone,
            'venue' => $request->venue,
            'venue_location' => $request->venue_location,
            'venue_phone' => $request->venue_phone,
            'meta_description' => $request->meta_description,
            'meta_title' => $request->meta_title,
            'meta_tags' => $request->meta_tags,
        ]);

        return redirect()->back()->with(['msg' => __('Event Update Success...'),'type'=>'success']);
    }

    public function single_page_settings(){
        $all_languages = Language::all();
        return view('backend.events.event-single-page-settings')->with(['all_languages' => $all_languages]);
    }

    public function update_single_page_settings(Request $request){
        $all_languages = Language::all();
        foreach ($all_languages as $lang){
            $this->validate($request,[
                'site_events_category_'.$lang->slug.'_title'  => 'nullable|string'
            ]);
            $all_fields = [
              'event_single_'.$lang->slug.'_event_info_title',
              'event_single_'.$lang->slug.'_date_title',
              'event_single_'.$lang->slug.'_time_title',
              'event_single_'.$lang->slug.'_cost_title',
              'event_single_'.$lang->slug.'_category_title',
              'event_single_'.$lang->slug.'_organizer_title',
              'event_single_'.$lang->slug.'_organizer_name_title',
              'event_single_'.$lang->slug.'_organizer_email_title',
              'event_single_'.$lang->slug.'_organizer_phone_title',
              'event_single_'.$lang->slug.'_organizer_website_title',
              'event_single_'.$lang->slug.'_venue_title',
              'event_single_'.$lang->slug.'_venue_name_title',
              'event_single_'.$lang->slug.'_venue_location_title',
              'event_single_'.$lang->slug.'_venue_phone_title',
              'event_single_'.$lang->slug.'_category_title',
              'event_single_'.$lang->slug.'_available_ticket_text',
              'event_single_'.$lang->slug.'_reserve_button_title',
              'event_single_'.$lang->slug.'_event_expire_text',
            ];
            foreach ($all_fields as $field){
                update_static_option($field,$request->$field);
            }
        }

        return redirect()->back()->with(['msg' => __('Events Single Page Settings Success...'),'type' => 'success']);
    }


    public function page_settings(){
        $all_languages = Language::all();
        return view('backend.events.event-page-settings')->with(['all_languages' => $all_languages]);
    }

    public function update_page_settings(Request $request){
        $this->validate($request,[
            'site_events_post_items' => 'required|string|max:191'
        ]);
        $all_languages = Language::all();
        foreach ($all_languages as $lang){
            $this->validate($request,[
                'site_events_category_'.$lang->slug.'_title'  => 'nullable|string'
            ]);
            $site_events_category_title = 'site_events_category_'.$lang->slug.'_title';
            update_static_option('site_events_category_'.$lang->slug.'_title',$request->$site_events_category_title);
        }
        update_static_option('site_events_post_items',$request->site_events_post_items);
        return redirect()->back()->with(['msg' => __('Events Page Settings Success...'),'type' => 'success']);
    }

    public function clone_event(Request $request){
        $event_details = Events::findOrFail($request->item_id);
        Events::create([
            'title' => $event_details->title,
            'slug' => ($event_details->slug) ? $event_details->slug.$event_details->id : \Str::slug($event_details->title),
            'content' => $event_details->content,
            'category_id' => $event_details->category_id,
            'status' => 'draft',
            'lang' => $event_details->lang,
            'date' => $event_details->date,
            'time' => $event_details->time,
            'cost' => $event_details->cost,
            'available_tickets' => $event_details->available_tickets,
            'image' => $event_details->image,
            'organizer' => $event_details->organizer,
            'organizer_email' => $event_details->organizer_email,
            'organizer_website' => $event_details->organizer_website,
            'organizer_phone' => $event_details->organizer_phone,
            'venue' => $event_details->venue,
            'venue_location' => $event_details->venue_location,
            'venue_phone' => $event_details->venue_phone,
            'meta_description' => $event_details->meta_description,
            'meta_tags' => $event_details->meta_tags,
            'meta_title' => $event_details->meta_title,
        ]);
        return redirect()->back()->with(['msg' => __('Events Clone Success...'),'type' => 'success']);
    }

    public function event_attendance(){
        $all_languages = Language::all();
        return view('backend.events.event-attendance-settings')->with(['all_languages' => $all_languages]);
    }

    public function update_event_attendance(Request $request){
        $this->validate($request,[
            'event_attendance_receiver_mail' => 'nullable|string|max:191'
        ]);
        $all_languages = Language::all();
        foreach ($all_languages as $lang){
            $this->validate($request,[
                'event_attendance_page_'.$lang->slug.'_title'  => 'nullable|string',
                'event_attendance_page_'.$lang->slug.'_form_button_title'  => 'nullable|string',
            ]);
            $field_list = [
                'event_attendance_page_'.$lang->slug.'_title',
                'event_attendance_page_'.$lang->slug.'_form_button_title'
            ];
            foreach ($field_list as $field){
                update_static_option($field,$request->$field);
            }

        }
        update_static_option('event_attendance_receiver_mail',$request->event_attendance_receiver_mail);

        return redirect()->back()->with(['msg' => __('Events Attendance Page Settings Success...'),'type' => 'success']);
    }

    public function event_attendance_logs(){
        $all_attendance = EventAttendance::all();
        return view('backend.events.event-attendance-all')->with(['all_attendance' => $all_attendance]);
    }

    public function delete_event_attendance_logs(Request $request,$id){
        $attendance_details = EventAttendance::findOrFail($id);
        $event_payment_logs = EventPaymentLogs::where('attendance_id',$attendance_details->id)->first();
        if (!empty($event_payment_logs)){
            return redirect()->back()->with(['msg' => 'Your Can not delete this attendance, it already associated with a event payment log.','type' => 'danger']);
        }
        $attendance_details->delete();
        return redirect()->back()->with(['msg' => 'Events Attendance Lob Deleted...','type' => 'danger']);
    }

    public function update_event_attendance_logs_status(Request $request){
        $event_attendance = EventAttendance::where('id',$request->attendance_id)->first();
        $event_attendance->status = $request->attendance_status;
        $payment_log = EventPaymentLogs::where('attendance_id',$event_attendance->id)->first();
        $mail_data['title'] = __('Booking Status Change');
        $mail_data['subject'] = __('Event Booking Status Change');
        $mail_data['name'] = $payment_log->name;
        $mail_data['message'] = '<p>'.__('Hello').'</p><p>'.__('Your booking order #'.$event_attendance->id.' status change to ').ucwords(str_replace('_',' ',$event_attendance->status)).'</p>';
        Mail::to($payment_log->email)->send(new OrderReply($mail_data,$mail_data['subject'],$mail_data['title']));

        return redirect()->back()->with(['msg' => __('Events Attendance Status Updated...'),'type' => 'success']);
    }

    public function send_mail_event_attendance_logs(Request $request){
        $this->validate($request,[
            'email' => 'required|string|max:191',
            'name' => 'required|string|max:191',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);
        $subject = str_replace('{site}',get_static_option('site_'.get_default_language().'_title'),$request->subject);
        $data = [
            'name' => $request->name,
            'message' => $request->message,
        ];
        Mail::to($request->email)->send(new OrderReply($data,$subject));
        return redirect()->back()->with(['msg' => __('Attendance Reply Mail Send Success...'),'type' => 'success']);
    }

    public function event_payment_logs(){
        $paymeng_logs = EventPaymentLogs::all();
        return view('backend.events.event-payment-logs-all')->with(['payment_logs' => $paymeng_logs]);
    }
    public function delete_event_payment_logs(Request $request,$id){
        EventPaymentLogs::findOrFail($id)->delete();
        return redirect()->back()->with(['msg' => __('Event Payment Log Delete Success...'),'type' => 'danger']);
    }

    public function approve_event_payment(Request $request,$id){
        $payment_logs = EventPaymentLogs::findOrFail($id);
        $payment_logs->status = 'complete';
        $payment_logs->save();

        EventAttendance::where('id',$payment_logs->order_id)->update(['payment_status' => 'complete']);

        Mail::to($payment_logs->email)->send(new PaymentSuccess($payment_logs,'event'));

        return redirect()->back()->with(['msg' => __('Manual Payment Accept Success'),'type' => 'success']);
    }

    public function payment_success_page_settings(){
        $all_languages = Language::all();
        return view('backend.events.event-payment-success-page')->with(['all_languages' => $all_languages]);
    }

    public function update_payment_success_page_settings(Request $request){
        $all_languages = Language::all();
        foreach ($all_languages as $lang){
            $this->validate($request,[
                'event_success_page_'.$lang->slug.'_title' => 'nullable|string',
                'event_success_page_'.$lang->slug.'_subtitle' => 'nullable|string',
                'event_success_page_'.$lang->slug.'_description' => 'nullable|string',
            ]);
            $all_fields = [
                'event_success_page_'.$lang->slug.'_title',
                'event_success_page_'.$lang->slug.'_subtitle',
                'event_success_page_'.$lang->slug.'_description',
            ];
            foreach ($all_fields as $field){
                update_static_option($field,$request->$field);
            }
        }
        return redirect()->back()->with(['msg' => __('Settings Update Success'),'type' => 'success']);
    }

    public function payment_cancel_page_settings(){
        $all_languages = Language::all();
        return view('backend.events.event-payment-cancel-page')->with(['all_languages' => $all_languages]);
    }

    public function update_payment_cancel_page_settings(Request $request){
        $all_languages = Language::all();
        foreach ($all_languages as $lang){
            $this->validate($request,[
                'event_cancel_page_'.$lang->slug.'_title' => 'nullable|string',
                'event_cancel_page_'.$lang->slug.'_subtitle' => 'nullable|string',
                'event_cancel_page_'.$lang->slug.'_description' => 'nullable|string',
            ]);
            $all_fields = [
                'event_cancel_page_'.$lang->slug.'_title',
                'event_cancel_page_'.$lang->slug.'_subtitle',
                'event_cancel_page_'.$lang->slug.'_description',
            ];
            foreach ($all_fields as $field){
                update_static_option($field,$request->$field);
            }
        }
        return redirect()->back()->with(['msg' => __('Settings Update Success'),'type' => 'success']);
    }

    public function bulk_action(Request $request){
        $all = Events::findOrFail($request->ids);
        foreach($all as $item){
            if ($request->type == 'delete'){
                $item->delete();
            }else{
                $item->status = $request->type;
                $item->save();
            }
        }
        return response()->json(['status' => 'ok']);
    }

    public function attendance_logs_bulk_action(Request $request){
        $all = EventAttendance::findOrFail($request->ids);
        foreach($all as $item){
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }
    public function payment_logs_bulk_action(Request $request){
        $all = EventPaymentLogs::findOrFail($request->ids);
        foreach($all as $item){
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }
    
    public function payment_report(Request  $request){
        $order_data = '';
        $query = EventPaymentLogs::query();
        if (!empty($request->start_date)){
            $query->whereDate('created_at','>=',$request->start_date);
        }
        if (!empty($request->end_date)){
            $query->whereDate('created_at','<=',$request->end_date);
        }
        if (!empty($request->payment_status)){
            $query->where(['status' => $request->payment_status ]);
        }
        $error_msg = __('select start & end date to generate event payment report');
        if (!empty($request->start_date) && !empty($request->end_date)){
            $query->orderBy('id','DESC');
            $order_data =  $query->paginate($request->items);
            $error_msg = '';
        }

        return view('backend.events.payment-report')->with([
            'order_data' => $order_data,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'items' => $request->items,
            'payment_status' => $request->payment_status,
            'error_msg' => $error_msg
        ]);
    }
    public function attendance_report(Request  $request){
        $order_data = '';
        $events = Events::where(['status' => 'publish','lang' => get_default_language()])->get();
        $query = EventAttendance::query();
        if (!empty($request->start_date)){
            $query->whereDate('created_at','>=',$request->start_date);
        }
        if (!empty($request->end_date)){
            $query->whereDate('created_at','<=',$request->end_date);
        }
        if (!empty($request->event_id)){
            $query->where(['event_id' => $request->event_id ]);
        }
        $error_msg = __('select start & end date to generate event attendance report');
        if (!empty($request->start_date) && !empty($request->end_date)){
            $query->orderBy('id','DESC');
            $order_data =  $query->paginate($request->items);
            $error_msg = '';
        }

        return view('backend.events.attendance-report')->with([
            'order_data' => $order_data,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'items' => $request->items,
            'event_id' => $request->event_id,
            'events' => $events,
            'error_msg' => $error_msg
        ]);
    }

}
