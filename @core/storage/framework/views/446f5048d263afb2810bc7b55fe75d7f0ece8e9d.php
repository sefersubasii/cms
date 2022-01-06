<div class="header-event-area">
    <?php if(!empty(get_static_option('event_home_page_topbar_section_status'))): ?>
        <div class="topbar-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="topbar-inner">
                            <div class="left-contnet">
                                <ul class="social-icon">
                                    <?php $__currentLoopData = $all_social_item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a href="<?php echo e($data->url); ?>"><i class="<?php echo e($data->icon); ?>"></i></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                            <div class="right-contnet">
                                <ul class="info-menu">
                                    <?php echo render_menu_by_id($top_menu_id); ?>

                                </ul>
                                <?php if(!empty(get_static_option('hide_frontend_language_change_option'))): ?>
                                    <div class="language_dropdown" id="languages_selector">
                                        <div class="selected-language"><?php echo e(get_language_name_by_slug(get_user_lang())); ?> <i class="fas fa-caret-down"></i></div>
                                        <ul>
                                            <?php $__currentLoopData = $all_language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li data-value="<?php echo e($lang->slug); ?>"><?php echo e($lang->name); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php echo $__env->make('frontend.partials.navbar-06', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <header class="header-area-wrapper header-carousel-two">
        <?php $__currentLoopData = $all_header_slider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="header-area style-03 header-bg"
                    <?php echo render_background_image_markup_by_attachment_id($data->image); ?>

            >
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="header-inner">
                                <h1 class="title"><?php echo e($data->title); ?></h1>
                                <p><?php echo e($data->description); ?></p>
                                <div class="btn-wrapper  desktop-left padding-top-20">
                                    <?php if(!empty($data->btn_01_status)): ?>
                                        <a href="<?php echo e($data->btn_01_url); ?>" class="boxed-btn btn-rounded white"><?php echo e($data->btn_01_text); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </header>
</div>
<?php if(!empty(get_static_option('event_home_page_featured_event_section_status'))): ?>
<div class="home-07header-bottom-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php
                    $event = \App\Events::find(get_static_option('home_page_07_featured_event'));
                ?>
                <?php if(!empty($event)): ?>
                <div class="featured-event-area-wrapper">
                    <div class="left-content-wrap">
                        <div class="countdown-wrapper">
                            <div id="featured_event_countdown" data-time="<?php echo e($event->date); ?>"></div>
                        </div>
                    </div>
                    <div class="right-content-wrap">
                        <span class="location"><i class="fas fa-map-marker-alt"></i> <?php echo e($event->venue_location); ?></span>
                        <span class="location"><i class="fas fa-calendar-alt"></i> <?php echo e($event->time); ?></span>
                        <div class="btn-wrapper">
                            <a href="<?php echo e(route('frontend.events.single',$event->slug)); ?>" class="boxed-btn"><?php echo e(get_static_option('home_page_07_'.$user_select_lang_slug.'_featured_area_button_title')); ?></a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if(!empty(get_static_option('event_home_page_why_attend_event_section_status'))): ?>
<div class="why-attend-event padding-top-120 padding-bottom-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title event-home desktop-center padding-bottom-50">
                    <span class="subtitle"><?php echo e(get_static_option('home_page_07_'.$user_select_lang_slug.'_attend_event_area_subtitle')); ?></span>
                    <h2 class="title"><?php echo e(get_static_option('home_page_07_'.$user_select_lang_slug.'_attend_event_area_title')); ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
                 $all_icon_fields =  get_static_option('home_page_07_icon_box_icon');
                 $all_icon_fields = !empty($all_icon_fields) ? unserialize($all_icon_fields) : [];
                 $all_title_fields = get_static_option('home_page_07_'.$user_select_lang_slug.'_icon_box_title');
                 $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : ['volunteers'];
                 $all_description_fields = get_static_option('home_page_07_'.$user_select_lang_slug.'_icon_box_description');
                 $all_description_fields = !empty($all_description_fields) ? unserialize($all_description_fields) : [];
            ?>
            <?php if(!empty($all_icon_fields)): ?>
                <?php $__currentLoopData = $all_icon_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $icon_field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-event-attend-box-one">
                            <span class="bg-icon"><i class="<?php echo e($icon_field); ?>"></i></span>
                            <div class="icon">
                                <i class="<?php echo e($icon_field); ?>"></i>
                            </div>
                            <div class="content">
                                <h4 class="title"><?php echo e($all_title_fields[$index]); ?></h4>
                                <p><?php echo e($all_description_fields[$index]); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if(!empty(get_static_option('event_home_page_speaker_section_status'))): ?>
<div class="even-speakers padding-bottom-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title event-home desktop-center padding-bottom-50">
                    <span class="subtitle"><?php echo e(get_static_option('home_page_07_'.$user_select_lang_slug.'_event_speaker_area_subtitle')); ?></span>
                    <h2 class="title"><?php echo e(get_static_option('home_page_07_'.$user_select_lang_slug.'_event_speaker_area_title')); ?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="event-team-carousel">
                    <?php $__currentLoopData = $all_team_members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="single-team-member-item-07">
                            <div class="thumb">
                                <?php echo render_image_markup_by_attachment_id($data->image,'','grid'); ?>

                                <div class="hover">
                                    <?php
                                        $social_fields = array(
                                            'icon_one' => 'icon_one_url',
                                            'icon_two' => 'icon_two_url',
                                            'icon_three' => 'icon_three_url',
                                        );
                                    ?>
                                    <ul class="social-icon">
                                        <?php $__currentLoopData = $social_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><a href="<?php echo e($data->$value); ?>"><i class="<?php echo e($data->$key); ?>"></i></a></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="content">
                                <h4 class="title"><?php echo e($data->name); ?></h4>
                                <span class="designation"><?php echo e($data->designation); ?></span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(get_static_option('event_home_page_counterup_section_status'))): ?>
<div class="counterup-area event-home padding-top-120 padding-bottom-110"
     <?php echo render_background_image_markup_by_attachment_id(get_static_option('home_07_counterup_bg_image')); ?>

>
    <div class="container">
        <div class="row">
            <?php $__currentLoopData = $all_counterup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-3 col-md-6">
                    <div class="counterup-wrap-07">
                        <div class="icon">
                            <i class="<?php echo e($data->icon); ?>"></i>
                        </div>
                        <div class="content">
                            <div class="count-wrap"><span class="count-num"><?php echo e($data->number); ?></span> <?php echo e($data->extra_text); ?></div>
                            <h5 class="title"><?php echo e($data->title); ?></h5>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(get_static_option('event_home_page_upcoming_event_section_status'))): ?>
<div class="upcoming-event padding-top-120 padding-bottom-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title event-home desktop-center padding-bottom-50">
                    <span class="subtitle"><?php echo e(get_static_option('home_page_07_'.$user_select_lang_slug.'_upcoming_event_area_subtitle')); ?></span>
                    <h2 class="title"><?php echo e(get_static_option('home_page_07_'.$user_select_lang_slug.'_upcoming_event_area_title')); ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="event-carousel">
                    <?php $__currentLoopData = $all_events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="single-event-item-style-07">
                            <div class="thumb">
                                <?php echo render_image_markup_by_attachment_id($data->image); ?>

                                <div class="hover">
                                    <div class="top-part">
                                        <?php if(!empty($data->cost)): ?>
                                        <div class="price-wrap"><?php echo e(amount_with_currency_symbol($data->cost)); ?></div>
                                        <?php endif; ?>
                                        <div class="cart-wrap"><a href="<?php echo e(route('frontend.events.single',$data->slug)); ?>"><i class="fas fa-shopping-cart"></i></a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="content">
                                <div class="top-part">
                                    <div class="time-warp">
                                        <span class="date"><?php echo e(date('d',strtotime($data->date))); ?></span>
                                        <span class="month"><?php echo e(date('M',strtotime($data->date))); ?></span>
                                    </div>
                                    <a href="<?php echo e(route('frontend.events.single',$data->slug)); ?>"><h4 class="title"><?php echo e($data->title); ?></h4></a>
                                </div>
                                <div class="content-wrap">
                                    <p><?php echo e(Str::words(strip_tags($data->content),20)); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(get_static_option('event_home_page_sponsors_logo_section_status'))): ?>
<div class="our-sponsors-area padding-bottom-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title event-home desktop-center padding-bottom-50">
                    <span class="subtitle"><?php echo e(get_static_option('home_page_07_'.$user_select_lang_slug.'_our_sponsors_area_subtitle')); ?></span>
                    <h2 class="title"><?php echo e(get_static_option('home_page_07_'.$user_select_lang_slug.'_our_sponsors_area_title')); ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="brand-carousel">
                    <?php $__currentLoopData = $all_brand_logo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="single-carousel event-home">
                            <?php if(!empty($data->url)): ?> <a href="<?php echo e($data->url); ?>"> <?php endif; ?>
                                <?php echo render_image_markup_by_attachment_id($data->image); ?>

                            <?php if(!empty($data->url)): ?></a> <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php if(!empty(get_static_option('home_page_07_our_sponsors_button_link'))): ?>
                <div class="btn-wrapper text-center margin-top-30">
                    <a href="<?php echo e(get_static_option('home_page_07_our_sponsors_button_link')); ?>" class="boxed-btn"><?php echo e(get_static_option('home_page_07_'.$user_select_lang_slug.'_our_sponsors_button_text')); ?></a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(get_static_option('event_home_page_latest_blog_section_status'))): ?>
<div class="new-area padding-top-120 padding-bottom-120 gray-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title event-home desktop-center padding-bottom-50">
                    <span class="subtitle"><?php echo e(get_static_option('home_page_07_'.$user_select_lang_slug.'_latest_news_area_subtitle')); ?></span>
                    <h2 class="title"><?php echo e(get_static_option('home_page_07_'.$user_select_lang_slug.'_latest_news_area_title')); ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="latest-news-carousel">
                    <?php $__currentLoopData = $all_blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="single-new-item-09">
                            <div class="thumb">
                                <?php echo render_image_markup_by_attachment_id($data->image,'','grid'); ?>

                            </div>
                            <div class="content">
                                <ul class="post-meta">
                                    <li><i class="fas fa-calendar-alt"></i> <a href="<?php echo e(route('frontend.blog.single',$data->slug)); ?>"><?php echo e(date_format($data->created_at,'d M y')); ?></a></li>
                                    <li><i class="fas fa-comment"></i> <a href="<?php echo e(route('frontend.blog.single',$data->slug)); ?>"><?php echo e(render_blog_author($data->author)); ?></a></li>
                                </ul>
                                <h4 class="title"><a href="<?php echo e(route('frontend.blog.single',$data->slug)); ?>"><?php echo e($data->title); ?></a></h4>
                                <a href="<?php echo e(route('frontend.blog.single',$data->slug)); ?>" class="readmore"><?php echo e(get_static_option('home_page_07_'.$user_select_lang_slug.'_news_blog_area_readmore_text')); ?> <i class="fas fa-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/beta/@core/resources/views/frontend/home-pages/home-07.blade.php ENDPATH**/ ?>