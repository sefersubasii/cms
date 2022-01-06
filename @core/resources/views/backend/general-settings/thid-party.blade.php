@extends('backend.admin-master')
@section('site-title')
    {{__('Third Party Scripts Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Third Party Scripts Settings")}}</h4>
                        <form action="{{route('admin.general.scripts.settings')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="site_header_script">{{__('Third Parity Scripts')}}</label>
                                <textarea name="site_header_script" cols="30" rows="5" class="form-control">{!! get_static_option('site_header_script') !!}</textarea>
                                <p>{{__('all of above code will be load in above </head> tag.')}}</p>
                            </div>
                            <div class="form-group">
                                <label for="site_google_analytics">{{__('Google Analytics')}}</label>
                                <input type="text" name="site_google_analytics"  class="form-control" value="{{get_static_option('site_google_analytics')}}" id="site_google_analytics">
                            </div>
                            <div class="form-group">
                                <label for="site_google_captcha_v3_site_key">{{__('Google Captcha V3 Site Key')}}</label>
                                <input type="text" name="site_google_captcha_v3_site_key"  class="form-control" value="{{get_static_option('site_google_captcha_v3_site_key')}}" id="site_google_captcha_v3_site_key">
                            </div>
                            <div class="form-group">
                                <label for="site_google_captcha_v3_secret_key">{{__('Google Captcha V3 Secret Key')}}</label>
                                <input type="text" name="site_google_captcha_v3_secret_key"  class="form-control" value="{{get_static_option('site_google_captcha_v3_secret_key')}}" id="site_google_captcha_v3_secret_key">
                            </div>
                            <div class="form-group">
                                <label for="site_disqus_key">{{__('Disqus')}}</label>
                                <textarea name="site_disqus_key"  cols="30" class="form-control" rows="5">{{get_static_option('site_disqus_key')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="tawk_api_key">{{__('Tawk.to API')}}</label>
                                <textarea name="tawk_api_key"  cols="30" class="form-control" rows="5">{{get_static_option('tawk_api_key')}}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
