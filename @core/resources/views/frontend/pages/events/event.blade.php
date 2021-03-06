@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('events_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    {{get_static_option('events_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('events_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('events_page_'.$user_select_lang_slug.'_meta_tags')}}">
@endsection
@section('content')
    <section class="blog-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12">
                        @foreach($all_events as $data)
                            <div class="single-events-list-item">
                                <div class="thumb">
                                    {!! render_image_markup_by_attachment_id($data->image,'','grid') !!}
                                </div>
                                <div class="content-area">
                                    <div class="top-part">
                                        <div class="time-wrap">
                                            <span class="date">{{date('d',strtotime($data->date))}}</span>
                                            <span class="month">{{date('M',strtotime($data->date))}}</span>
                                        </div>
                                        <div class="title-wrap">
                                            <a href="{{route('frontend.events.single',$data->slug)}}"><h4 class="title">{{$data->title}}</h4></a>
                                            <span class="location"><i class="fas fa-map-marker-alt"></i> {{$data->location}}</span>
                                        </div>
                                    </div>
                                    <p>{{Str::words(strip_tags($data->content),20)}}</p>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    <div class="col-lg-12 text-center">
                        <nav class="pagination-wrapper " aria-label="Page navigation ">
                            {{$all_events->links()}}
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area">
                        <div class="widget widget_search">
                            <form action="{{route('frontend.events.search')}}" method="get" class="search-form">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="search" placeholder="{{__('Search...')}}">
                                </div>
                                <button class="submit-btn" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="widget widget_nav_menu">
                            <h2 class="widget-title">{{get_static_option('site_events_category_'.$user_select_lang_slug.'_title')}}</h2>
                            <ul>
                                @foreach($all_event_category as $data)
                                    <li><a href="{{route('frontend.events.category',['id' => $data->id,'any'=> Str::slug($data->title,'-')])}}">{{ucfirst($data->title)}}</a></li>
                                @endforeach
                            </ul>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
