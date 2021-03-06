@extends('frontend.frontend-page-master')
@section('site-title')
    {{$event->meta_title ?? $event->title}}
@endsection
@section('page-title')
    {{$event->title}}
@endsection
@section('breadcrumb')
    <li>{!! get_events_category_by_id($event->category_id,'link') !!}</li>
    <li>{{$event->title}}</li>
@endsection
@section('edit_link')
    <li><a href="{{route('admin.events.edit',$event->id)}}"><i class="far fa-edit"></i> {{__('Edit Event')}}</a></li>
@endsection
@section('content')
    <section class="blog-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="single-event-details">
                        <div class="thumb">
                            {!! render_image_markup_by_attachment_id($event->image,'','full') !!}
                        </div>
                        <div class="content">
                            <div class="details-content-area">
                                {!! $event->content !!}
                            </div>
                        </div>
                        <div class="event-venue-details-information margin-top-40">
                            <h4 class="venue-title">{{get_static_option('event_single_'.$user_select_lang_slug.'_venue_title')}}</h4>
                            <div class="bottom-content">
                                <div class="venue-details">
                                    @if(!empty($event->venue))
                                        <div class="venue-details-block">
                                            <h4 class="title">{{get_static_option('event_single_'.$user_select_lang_slug.'_venue_name_title')}}</h4>
                                            <span class="details">{{$event->venue}}</span>
                                        </div>
                                    @endif
                                    @if(!empty($event->venue_location))
                                        <div class="venue-details-block">
                                            <h4 class="title">{{get_static_option('event_single_'.$user_select_lang_slug.'_venue_location_title')}}</h4>
                                            <span class="details">{{$event->venue_location}}</span>
                                        </div>
                                    @endif
                                    @if(!empty($event->venue_phone))
                                        <div class="venue-details-block">
                                            <h4 class="title">{{get_static_option('event_single_'.$user_select_lang_slug.'_venue_phone_title')}}</h4>
                                            <span class="details">{{$event->venue_phone}}</span>
                                        </div>
                                    @endif
                                </div>
                                @if(!empty($event->venue_location))
                                    <div class="map-location">
                                        {!! render_embed_google_map($event->venue_location) !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if(time() >= strtotime($event->date) && $event->available_tickets > 0)
                            <p class="alert alert-danger  margin-top-30">{{get_static_option('event_single_'.$user_select_lang_slug.'_event_expire_text')}}</p>
                        @else
                            <div class="reserve-event-seat margin-top-30">
                                <a href="{{route('frontend.event.booking',$event->id)}}" class="boxed-btn style-01">{{get_static_option('event_single_'.$user_select_lang_slug.'_reserve_button_title')}}</a>
                                <p class="info-text padding-top-10">{{get_static_option('event_single_'.$user_select_lang_slug.'_available_ticket_text').' '.$event->available_tickets}}</p>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area">
                        <div class="counterdown-wrap event-page">
                            <div id="event_countdown"></div>
                        </div>
                        <div class="widget widget_search">
                            <form action="{{route('frontend.events.search')}}" method="get" class="search-form">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="search" placeholder="{{__('Search...')}}">
                                </div>
                                <button class="submit-btn" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="widget event-info">
                            <h4 class="widget-title">{{get_static_option('event_single_'.$user_select_lang_slug.'_event_info_title')}}</h4>
                            <ul class="icon-with-title-description">
                                <li>
                                    <div class="icon"><i class="far fa-calendar-plus"></i></div>
                                    <div class="content">
                                        <h4 class="title">{{get_static_option('event_single_'.$user_select_lang_slug.'_date_title')}}</h4>
                                        <span class="details">{{date('d M Y',strtotime($event->date))}}</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon"><i class="fas fa-clock"></i></div>
                                    <div class="content">
                                        <h4 class="title">{{get_static_option('event_single_'.$user_select_lang_slug.'_time_title')}}</h4>
                                        <span class="details">{{$event->time}}</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon"><i class="fas fa-dollar-sign"></i></div>
                                    <div class="content">
                                        <h4 class="title">{{get_static_option('event_single_'.$user_select_lang_slug.'_cost_title')}}</h4>
                                        <span class="details">{{amount_with_currency_symbol($event->cost)}}</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon"><i class="far fa-folder-open"></i></div>
                                    <div class="content">
                                        <h4 class="title">{{get_static_option('event_single_'.$user_select_lang_slug.'_category_title')}}</h4>
                                        <span class="details">
                                           {!! get_events_category_by_id($event->category_id,'link') !!}
                                        </span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="widget event-info">
                            <h4 class="widget-title">{{get_static_option('event_single_'.$user_select_lang_slug.'_organizer_title')}}</h4>
                            <ul class="icon-with-title-description">
                                @if(!empty($event->organizer))
                                    <li>
                                        <div class="icon"><i class="fas fa-store"></i></div>
                                        <div class="content">
                                            <h4 class="title">{{get_static_option('event_single_'.$user_select_lang_slug.'_organizer_name_title')}}</h4>
                                            <span class="details">{{$event->organizer}}</span>
                                        </div>
                                    </li>
                                @endif
                                @if(!empty($event->organizer_email))
                                    <li>
                                        <div class="icon"><i class="fas fa-envelope"></i></div>
                                        <div class="content">
                                            <h4 class="title">{{get_static_option('event_single_'.$user_select_lang_slug.'_organizer_email_title')}}</h4>
                                            <span class="details">{{$event->organizer_email}}</span>
                                        </div>
                                    </li>
                                @endif
                                @if(!empty($event->organizer_phone))
                                    <li>
                                        <div class="icon"><i class="fas fa-phone-alt"></i></div>
                                        <div class="content">
                                            <h4 class="title">{{get_static_option('event_single_'.$user_select_lang_slug.'_organizer_phone_title')}}</h4>
                                            <span class="details">{{$event->organizer_phone}}</span>
                                        </div>
                                    </li>
                                @endif
                                @if(!empty($event->organizer_website))
                                    <li>
                                        <div class="icon"><i class="fas fa-globe"></i></div>
                                        <div class="content">
                                            <h4 class="title">{{get_static_option('event_single_'.$user_select_lang_slug.'_organizer_website_title')}}</h4>
                                            <span class="details">{{$event->organizer_website}}</span>
                                        </div>
                                    </li>
                                @endif
                            </ul>
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
@section('scripts')
    <script src="{{asset('assets/common/js/countdown.jquery.js')}}"></script>
    <script>
        var ev_offerTime = "{{$event->date}}";
        var ev_year = ev_offerTime.substr(0, 4);
        var ev_month = ev_offerTime.substr(5, 2);
        var ev_day = ev_offerTime.substr(8, 2);
        
        if (ev_offerTime) {
            $('#event_countdown').countdown({
                year: ev_year,
                month: ev_month,
                day: ev_day,
                labels: true,
                labelText: {
                    'days': "{{__('days')}}",
                    'hours': "{{__('hours')}}",
                    'minutes': "{{__('min')}}",
                    'seconds': "{{__('sec')}}",
                }
            });
        }
    </script>
@endsection
