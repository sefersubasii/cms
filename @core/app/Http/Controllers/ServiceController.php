<?php

namespace App\Http\Controllers;

use App\Jobs;
use App\Language;
use App\ServiceCategory;
use App\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $all_services = Services::all()->groupBy('lang');
        $service_category = ServiceCategory::where(['status' => 'publish','lang' => get_default_language()])->get();
        return view('backend.pages.service.index')->with(['all_services' => $all_services,'service_category' => $service_category]);
    }

    public function new(){
        $all_languages = Language::all();
        $service_category = ServiceCategory::where(['status' => 'publish','lang' => get_default_language()])->get();
        return view('backend.pages.service.new-service')->with([
            'service_category' => $service_category,
            'all_languages' => $all_languages,
        ]);
    }

    public function edit($id){

        $service = Services::findOrFail($id);
        $all_languages = Language::all();
        $service_category = ServiceCategory::where(['status' => 'publish','lang' => get_default_language()])->get();

        return view('backend.pages.service.edit-service')->with([
            'service_category' => $service_category,
            'all_languages' => $all_languages,
            'service' => $service
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'title' => 'required|string|max:191',
            'icon' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'service_content' => 'required|string',
            'excerpt' => 'required|string',
            'categories_id' => 'required|string',
            'image' => 'nullable|string|max:191',
            'status' => 'required|string|max:191',
            'slug' => 'nullable|string|max:191',
            'meta_description' => 'nullable|string|max:191',
            'meta_tags' => 'nullable|string|max:191',
            'img_icon' => 'nullable|string|max:191',
            'icon_type' => 'nullable|string|max:191',
        ]);
        $job_slug = !empty($request->slug) ? Str::slug($request->slug) : Str::slug($request->title);
        $check_slug = Services::where('slug',$job_slug)->get();

        if (count($check_slug) > 0){
            $job_slug .= count($check_slug) + 1;
        }
        Services::create([
            'title' => $request->title,
            'icon' => $request->icon,
            'lang' => $request->lang,
            'description' => $request->service_content,
            'excerpt' => $request->excerpt,
            'categories_id' => $request->categories_id,
            'image' => $request->image,
            'status' => $request->status,
            'slug' => $job_slug,
            'meta_description' => $request->meta_description,
            'meta_tags' => $request->meta_tags,
            'img_icon' => $request->img_icon,
            'meta_title' => $request->meta_title,
            'icon_type' => $request->icon_type,
        ]);

        return redirect()->back()->with(['msg' => __('New service Added...'),'type' => 'success']);
    }
    public function clone(Request $request){
        $service = Services::findOrFail($request->item_id);
        $job_slug = !empty($service->slug) ? Str::slug($service->slug) : Str::slug($service->title);
        $check_slug = Services::where('slug',$job_slug)->get();

        if (count($check_slug) > 1){
            $job_slug .= count($check_slug) + 1;
        }
        Services::create([
            'title' => $service->title,
            'icon' => $service->icon,
            'lang' => $service->lang,
            'description' => $service->description,
            'excerpt' => $service->excerpt,
            'categories_id' => $service->categories_id,
            'image' => $service->image,
            'status' => 'draft',
            'slug' => $job_slug,
            'meta_description' => $service->meta_description,
            'meta_tags' => $service->meta_tags,
            'img_icon' => $service->img_icon,
            'meta_title' => $service->meta_title,
            'icon_type' => $service->icon_type,
        ]);

        return redirect()->back()->with(['msg' => __('service Cloned...'),'type' => 'success']);
    }

    public function update(Request $request){

        $this->validate($request,[
            'title' => 'required|string|max:191',
            'icon' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'service_content' => 'required|string',
            'excerpt' => 'required|string',
            'categories_id' => 'required|string',
            'image' => 'nullable|string|max:191',
            'status' => 'required|string|max:191',
            'slug' => 'nullable|string|max:191',
            'meta_description' => 'nullable|string|max:191',
            'meta_tags' => 'nullable|string|max:191',
            'img_icon' => 'nullable|string|max:191',
            'icon_type' => 'nullable|string|max:191',
        ]);
        $job_slug = !empty($request->slug) ? Str::slug($request->slug) : Str::slug($request->title);
       
        Services::findOrFail($request->id)->update([
            'title' => $request->title,
            'icon' => $request->icon,
            'lang' => $request->lang,
            'description' => $request->service_content,
            'excerpt' => $request->excerpt,
            'categories_id' => $request->categories_id,
            'image' => $request->image,
            'status' => $request->status,
            'slug' => $job_slug,
            'meta_description' => $request->meta_description,
            'meta_tags' => $request->meta_tags,
            'img_icon' => $request->img_icon,
            'icon_type' => $request->icon_type,
            'meta_title' => $request->meta_title,
        ]);

        return redirect()->back()->with(['msg' => __('Service Item Updated...'),'type' => 'success']);
    }

    public function delete($id){
        Services::findOrFail($id)->delete();

        return redirect()->back()->with(['msg' => __('Delete Success...'),'type' => 'danger']);
    }

    public function category_index(){
        $all_category = ServiceCategory::all()->groupBy('lang');
        return view('backend.pages.service.category')->with(['all_category' => $all_category]);
    }

    public function category_store(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'status' => 'required|string|max:191',
            'icon_type' => 'required|string|max:191',
            'icon' => 'nullable|string|max:191',
            'img_icon' => 'nullable|string|max:191',
        ]);

        ServiceCategory::create([
            'name' => $request->name,
            'lang' => $request->lang,
            'status' => $request->status,
            'icon_type' => $request->icon_type,
            'icon' => $request->icon,
            'img_icon' => $request->img_icon,
        ]);

        return redirect()->back()->with([
            'msg' => __('New Category Added...'),
            'type' => 'success'
        ]);
    }

    public function category_update(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'status' => 'required|string|max:191',
            'icon_type' => 'required|string|max:191',
            'icon' => 'nullable|string|max:191',
            'img_icon' => 'nullable|string|max:191',
        ]);

        ServiceCategory::findOrFail($request->id)->update([
            'name' => $request->name,
            'lang' => $request->lang,
            'status' => $request->status,
            'icon_type' => $request->icon_type,
            'icon' => $request->icon,
            'img_icon' => $request->img_icon,
        ]);

        return redirect()->back()->with([
            'msg' => __('Category Update Success...'),
            'type' => 'success'
        ]);
    }

    public function category_delete(Request $request,$id){
        if (Services::where('categories_id',$id)->first()){
            return redirect()->back()->with([
                'msg' => __('You Can Not Delete This Category, It Already Associated With A Service...'),
                'type' => 'danger'
            ]);
        }
        ServiceCategory::findOrFail($id)->delete();
        return redirect()->back()->with([
            'msg' => __( 'Category Delete Success...'),
            'type' => 'danger'
        ]);
    }

    public function category_by_slug(Request $request){
        $service_category = ServiceCategory::where(['status' => 'publish','lang' => $request->lang])->get();
        return response()->json($service_category);
    }

    public function category_bulk_action(Request $request){

        $all = ServiceCategory::findOrFail($request->ids);
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
    public function bulk_action(Request $request){

        $all = Services::findOrFail($request->ids);
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

     public function single_page_settings(){
            $all_languages = Language::all();
            return view('backend.pages.service.service-single-settings')->with(['all_languages' => $all_languages]);
     }

     public function update_single_page_settings(Request  $request){
        $all_languages = Language::all();

        foreach ($all_languages as $lang){
            $this->validate($request,[
                'service_single_page_'.$lang->slug.'_category_title' => 'nullable|string',
                'service_single_page_'.$lang->slug.'_recent_services_title' => 'nullable|string',
                'service_single_page_'.$lang->slug.'_search_placeholder_text' => 'nullable|string',
            ]);

            $fields = [
                'service_single_page_'.$lang->slug.'_category_title',
                'service_single_page_'.$lang->slug.'_recent_services_title' ,
                'service_single_page_'.$lang->slug.'_search_placeholder_text'
            ];

            foreach ($fields as $field) {
                update_static_option($field,$request->$field);
            }
        }

        return redirect()->back()->with(['msg' => __('settings update success'),'type' => 'success']);
     }
}
