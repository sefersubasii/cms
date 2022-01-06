<div class="service-header"  <?php echo render_background_image_markup_by_attachment_id(get_static_option('home_page_06_header_background_image')); ?>>
    <?php if(!empty(get_static_option('service_home_page_topbar_section_status'))): ?>
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
    <?php echo $__env->make('frontend.partials.navbar-05', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <header class="header-area-wrapper">
        <div class="right-image-wrap">
            <?php echo render_image_markup_by_attachment_id(get_static_option('home_page_06_header_right_image')); ?>

        </div>
            <div class="header-area header-style-06">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="header-inner">
                                <h1 class="title"><?php echo e(get_static_option('home_page_06_'.$user_select_lang_slug.'_header_area_title')); ?></h1>
                                <p><?php echo e(get_static_option('home_page_06_'.$user_select_lang_slug.'_header_area_description')); ?></p>
                                <div class="search-wrapper">
                                    <form action="<?php echo e(route('frontend.gigs.search')); ?>" method="get">
                                        <input type="text" class="form-control" name="s" placeholder="<?php echo e(__('Search here')); ?>">
                                        <button class="search-btn" type="submit"><i class="fas fa-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </header>
</div>
<?php if(!empty(get_static_option('service_home_page_category_section_status'))): ?>
<div class="gigs-category-area padding-bottom-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="gigs-category-carousel">
                    <?php $a = 1;?>
                    <?php $__currentLoopData = $all_gig_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="single-gig-category">
                        <?php if($data->icon_type == 'icon' || $data->icon_type == ''): ?>
                            <div class="icon style-<?php echo e($a); ?>">
                                <i class="<?php echo e($data->icon); ?>"></i>
                            </div>
                        <?php else: ?>
                            <div class="img-icon style-<?php echo e($a); ?>">
                                <?php echo render_image_markup_by_attachment_id($data->img_icon); ?>

                            </div>
                        <?php endif; ?>
                        <div class="content">
                            <h4 class="title"><a href="<?php echo e(route('frontend.gigs.category',['id' => $data->id, 'any' => Str::slug($data->name)])); ?>"><?php echo e($data->name); ?></a></h4>
                        </div>
                    </div>
                        <?php if ($a == 5){ $a = 1;}else{ $a++;} ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(get_static_option('service_home_page_video_section_status'))): ?>
<div class="video-area-wrapper padding-bottom-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="video-container-wrap">
                   <div class="thumb">
                       <?php echo render_image_markup_by_attachment_id(get_static_option('home_page_06_video_area_background_image')); ?>

                       <div class="hover">
                           <a href="<?php echo e(get_static_option('home_page_06_video_area_video_url')); ?>" class="video-popup mfp-iframe"><i class="fas fa-play"></i></a>
                       </div>
                   </div>
                </div>
                <?php if(!empty(get_static_option('service_home_page_brand_carousel_section_status'))): ?>
                <div class="brand-carousel-wrapper padding-top-80">
                    <div class="brand-carousel">
                        <?php $__currentLoopData = $all_brand_logo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="single-carousel service-home">
                                <?php if(!empty($data->url)): ?> <a href="<?php echo e($data->url); ?>"> <?php endif; ?>
                                    <?php echo render_image_markup_by_attachment_id($data->image); ?>

                                    <?php if(!empty($data->url)): ?></a> <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(get_static_option('service_home_page_all_services_section_status'))): ?>
<div class="all-services-area padding-top-120 padding-bottom-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center padding-bottom-50">
                    <h2 class="title"><?php echo e(get_static_option('home_page_06_'.$user_select_lang_slug.'_our_service_area_title')); ?></h2>
                    <p><?php echo e(get_static_option('home_page_06_'.$user_select_lang_slug.'_our_service_area_description')); ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php $__currentLoopData = $all_gigs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-md-6">
                <div class="single-gig-item">
                    <div class="thumb">
                        <?php echo render_image_markup_by_attachment_id($data->image,'','grid'); ?>

                        <div class="price-wrap">
                           <?php echo e(__("Start From").' '.gig_start_price($data->id)); ?>

                        </div>
                        <a href="<?php echo e(route('frontend.gigs.single',$data->slug)); ?>" class="order-btn"><i class="fas fa-shopping-cart"></i></a>
                    </div>
                    <div class="content">
                        <h4 class="title"><a href="<?php echo e(route('frontend.gigs.single',$data->slug)); ?>"><?php echo e($data->title); ?></a></h4>
                        <p><?php echo Str::words(strip_tags($data->description),20); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-12">
                <div class="btn-wrapper desktop-center margin-top-60">
                    <a href="<?php echo e(route('frontend.gigs')); ?>" class="boxed-btn service-home"><?php echo e(get_static_option('home_page_06_'.$user_select_lang_slug.'_our_service_area_button_text')); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(get_static_option('service_home_page_counterup_section_status'))): ?>
<div class="counterup-area padding-top-115 padding-bottom-115"
        <?php echo render_background_image_markup_by_attachment_id(get_static_option('home_06_counterup_bg_image')); ?>

>
    <div class="container">
        <div class="row">
            <?php $__currentLoopData = $all_counterup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-3 col-md-6">
                    <div class="single-counterup-item-06">
                        <div class="icon">
                            <i class="<?php echo e($data->icon); ?>" aria-hidden="true"></i>
                        </div>
                        <div class="content">
                            <div class="count-wrap"><span class="count-num"><?php echo e($data->number); ?></span><?php echo e($data->extra_text); ?></div>
                            <h4 class="title"><?php echo e($data->title); ?></h4>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(get_static_option('service_home_page_work_process_section_status'))): ?>
<div class="our-work-process-area padding-top-120 padding-bottom-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center padding-bottom-50">
                    <h2 class="title"><?php echo e(get_static_option('home_page_06_'.$user_select_lang_slug.'_work_process_area_title')); ?></h2>
                    <p><?php echo e(get_static_option('home_page_06_'.$user_select_lang_slug.'_work_process_area_description')); ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="work-process-wrap">
                    <?php
                        $all_icon_fields =  get_static_option('home_page_06_work_process_number');
                        $all_icon_fields = !empty($all_icon_fields) ? unserialize($all_icon_fields) : ['1'];
                    ?>
                    <?php if(count($all_icon_fields) > 0): ?>
                    <ul class="work-process-list">
                        <?php
                            $all_title_fields = get_static_option('home_page_06_'.$user_select_lang_slug.'_work_process_title');
                            $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [__('Signup/Login')];
                            $a = 1;
                        ?>
                        <?php $__currentLoopData = $all_icon_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $icon_field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="single-work-item-06">
                            <div class="number style-<?php echo e($a); ?>"><?php echo e($icon_field); ?></div>
                            <div class="content">
                                <h4 class="title"><?php echo e($all_title_fields[$index]); ?></h4>
                            </div>
                        </li>
                        <?php if($a == 5){$a = 1;}else{$a++;} ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(get_static_option('service_home_page_testimonial_section_status'))): ?>
<div class="testimonial-area padding-bottom-100 padding-top-80">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="section-title">
                    <h2 class="title"><?php echo e(get_static_option('home_page_06_'.$user_select_lang_slug.'_testimonial_area_title')); ?></h2>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="testimonial-wrapper-job-home">
                    <div class="testimonial-carousel-job-home">
                        <?php $__currentLoopData = $all_testimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="single-testimonial-item-10">
                                <div class="top-part">
                                    <div class="thumb">
                                        <?php echo render_image_markup_by_attachment_id($data->image); ?>

                                    </div>
                                    <div class="author">
                                        <h4 class="title"><?php echo e($data->name); ?></h4>
                                        <span class="designation"><?php echo e($data->designation); ?></span>
                                    </div>
                                </div>
                                <div class="bottom-part">
                                    <i class="fas fa-quote-left"></i>
                                    <p><?php echo e($data->description); ?></p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(get_static_option('service_home_page_latest_news_section_status'))): ?>
<div class="news-area padding-top-120 padding-bottom-90 service-home-bg"
<?php echo render_background_image_markup_by_attachment_id(get_static_option('home_06_news_area_background_image')); ?>

>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center padding-bottom-50">
                    <h2 class="title"><?php echo e(get_static_option('home_page_06_'.$user_select_lang_slug.'_news_area_title')); ?></h2>
                    <p><?php echo e(get_static_option('home_page_06_'.$user_select_lang_slug.'_news_area_description')); ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="latest-news-carousel service-home">
                    <?php $__currentLoopData = $all_blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="news-item-style-06">
                            <div class="thumb">
                                <?php echo render_image_markup_by_attachment_id($data->image); ?>

                            </div>
                            <div class="content">
                                <ul class="post-meta">
                                    <li><i class="far fa-calendar-alt"></i> <a href="<?php echo e(route('frontend.blog.single',$data->slug)); ?>"><?php echo e(date_format($data->created_at,'d M y')); ?></a></li>
                                    <li><i class="far fa-user"></i> <a href="<?php echo e(route('frontend.blog.single',$data->slug)); ?>"><?php echo e(render_blog_author($data->author)); ?></a></li>
                                </ul>
                                <h4 class="title"><a href="<?php echo e(route('frontend.blog.single',$data->slug)); ?>"><?php echo e($data->title); ?></a></h4>
                                <a href="<?php echo e(route('frontend.blog.single',$data->slug)); ?>" class="readmore"><?php echo e(get_static_option('home_page_06_'.$user_select_lang_slug.'_news_area_read_more_text')); ?></a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/@core/resources/views/frontend/home-pages/home-06.blade.php ENDPATH**/ ?>