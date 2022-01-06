@extends('backend.admin-master')

@section('site-title')
    {{__('Section Manage')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend/partials/message')
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Section Manage')}}</h4>
                        <form action="{{route('admin.job.home.section.manage')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="job_home_page_topbar_section_status"><strong>{{__('Topbar Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="job_home_page_topbar_section_status"  @if(!empty(get_static_option('job_home_page_topbar_section_status'))) checked @endif >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="job_home_page_category_section_status"><strong>{{__('Category Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="job_home_page_category_section_status"  @if(!empty(get_static_option('job_home_page_category_section_status'))) checked @endif >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="job_home_page_featured_job_section_status"><strong>{{__('Featured Job Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="job_home_page_featured_job_section_status"  @if(!empty(get_static_option('job_home_page_featured_job_section_status'))) checked @endif >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="job_home_page_featured_job_section_status"><strong>{{__('Featured Job Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="job_home_page_featured_job_section_status"  @if(!empty(get_static_option('job_home_page_featured_job_section_status'))) checked @endif >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="job_home_page_millions_section_status"><strong>{{__('Millions Job Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="job_home_page_millions_section_status"  @if(!empty(get_static_option('job_home_page_millions_section_status'))) checked @endif >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="job_home_page_latest_job_section_status"><strong>{{__('Latest Job Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="job_home_page_latest_job_section_status"  @if(!empty(get_static_option('job_home_page_latest_job_section_status'))) checked @endif >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="job_home_page_latest_news_section_status"><strong>{{__('Latest News Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="job_home_page_latest_news_section_status"  @if(!empty(get_static_option('job_home_page_latest_news_section_status'))) checked @endif >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="job_home_page_testimonial_section_status"><strong>{{__('Testimonial Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="job_home_page_testimonial_section_status"  @if(!empty(get_static_option('job_home_page_testimonial_section_status'))) checked @endif >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="job_home_page_brand_carousel_section_status"><strong>{{__('Brand Carousel Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="job_home_page_brand_carousel_section_status"  @if(!empty(get_static_option('job_home_page_brand_carousel_section_status'))) checked @endif >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

