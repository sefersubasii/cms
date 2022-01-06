<?php $page_name = get_static_option('about_page_'.$user_select_lang_slug.'_name'); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e($page_name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e($page_name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li> <?php echo e($page_name); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e(get_static_option('about_page_'.$user_select_lang_slug.'_meta_tags')); ?>">
    <meta name="tags" content="<?php echo e(get_static_option('about_page_'.$user_select_lang_slug.'_meta_description')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php if(!empty(get_static_option('about_page_about_us_section_status'))): ?>
    <div class="who-we-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="left-content-area">
                        <div class="aboutus-content-block margin-bottom-50">
                            <h4 class="title"><?php echo e(get_static_option('about_page_'.$user_select_lang_slug.'_about_section_title')); ?></h4>
                            <p><?php echo e(get_static_option('about_page_'.$user_select_lang_slug.'_about_section_description')); ?></p>
                        </div>
                        <div class="row">
                            <?php $__currentLoopData = $all_service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-6">
                                <div class="icon-box-three margin-bottom-25">
                                    <div class="icon">
                                        <i class="<?php echo e($data->icon); ?>"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title"><?php echo e($data->title); ?></h4>
                                        <p><?php echo e($data->excerpt); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="img-wrapper">
                        <?php echo render_image_markup_by_attachment_id(get_static_option('about_page_'.$user_select_lang_slug.'_about_section_right_image')); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if(!empty(get_static_option('about_page_know_about_section_status'))): ?>
    <section class="our-work-area padding-top-110 padding-bottom-120 section-bg-1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title desktop-center margin-bottom-55">
                        <h2 class="title"><?php echo e(get_static_option('about_page_'.$user_select_lang_slug.'_know_about_section_title')); ?></h2>
                        <p><?php echo e(get_static_option('about_page_'.$user_select_lang_slug.'_know_about_section_description')); ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php $__currentLoopData = $all_know_about; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6">
                    <div class="single-work-item-02">
                        <div class="thumb">
                            <?php echo render_image_markup_by_attachment_id($data->image,'','grid'); ?>

                        </div>
                        <div class="content">
                            <a href="<?php echo e($data->link); ?>"><h4 class="title"><?php echo e($data->title); ?></h4></a>
                            <p><?php echo e($data->description); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
<?php if(!empty(get_static_option('about_page_call_to_action_section_status'))): ?>
    <section class="cta-area-one cta-bg-one padding-top-95 padding-bottom-100"
             <?php echo render_background_image_markup_by_attachment_id(get_static_option('home_page_01_'.$user_select_lang_slug.'_cta_background_image')); ?>

    >
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="left-content-area">
                        <h3 class="title"><?php echo e(get_static_option('home_page_01_'.$user_select_lang_slug.'_cta_area_title')); ?></h3>
                        <p><?php echo e(get_static_option('home_page_01_'.$user_select_lang_slug.'_cta_area_description')); ?></p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="right-content-area">
                        <div class="btn-wrapper">
                            <a href="<?php echo e(get_static_option('home_page_01_'.$user_select_lang_slug.'_cta_area_button_url')); ?>" class="boxed-btn btn-rounded white"><?php echo e(get_static_option('home_page_01_'.$user_select_lang_slug.'_cta_area_button_title')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
<?php if(!empty(get_static_option('about_page_team_member_section_status'))): ?>
    <section class="meet-the-team-area section-bg-1 padding-top-110 padding-bottom-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title desktop-center margin-bottom-55">
                        <h2 class="title"><?php echo e(get_static_option('home_page_01_'.$user_select_lang_slug.'_team_member_section_title')); ?></h2>
                        <p><?php echo e(get_static_option('home_page_01_'.$user_select_lang_slug.'_team_member_section_description')); ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="team-carousel">
                        <?php $__currentLoopData = $all_team_members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="single-team-member-one">
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
                                    <h4 class="name"><?php echo e($data->name); ?></h4>
                                    <span class="designation"><?php echo e($data->designation); ?></span>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
<?php if(!empty(get_static_option('about_page_testimonial_section_status'))): ?>
    <section class="testimonial-area testimonial-bg padding-top-110 padding-bottom-120"
             <?php echo render_background_image_markup_by_attachment_id(get_static_option('home_01_testimonial_bg')); ?>

    >
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="testimonial-carousel">
                        <?php $__currentLoopData = $all_testimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="single-testimonial-item white">
                                <div class="icon">
                                    <i class="flaticon-quote"></i>
                                </div>
                                <p><?php echo e($data->description); ?> </p>
                                <div class="author-meta">
                                    <h4 class="name"><?php echo e($data->name); ?></h4>
                                    <span class="designation"><?php echo e($data->designation); ?></span>
                                </div>
                                <div class="thumb">
                                    <?php echo render_image_markup_by_attachment_id($data->image,'','full'); ?>

                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
<?php if(!empty(get_static_option('about_page_latest_news_section_status'))): ?>
    <section class="latest-news padding-top-110 padding-bottom-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title desktop-center margin-bottom-55">
                        <h2 class="title"><?php echo e(get_static_option('home_page_01_'.$user_select_lang_slug.'_latest_news_title')); ?></h2>
                        <p><?php echo e(get_static_option('home_page_01_'.$user_select_lang_slug.'_latest_news_description')); ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="latest-news-carousel">
                        <?php $__currentLoopData = $all_blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="single-blog-grid-01">
                                <div class="thumb">
                                    <?php echo render_image_markup_by_attachment_id($data->image,'','grid'); ?>

                                </div>
                                <div class="content">
                                    <h4 class="title"><a href="<?php echo e(route('frontend.blog.single',$data->slug)); ?>"><?php echo e($data->title); ?></a></h4>
                                    <ul class="post-meta">
                                        <li><a href="#"><i class="fa fa-calendar"></i> <?php echo e(date_format($data->created_at,'d M y')); ?></a></li>
                                        <li><a href="#"><i class="fa fa-user"></i> <?php echo e(render_blog_author($data->author)); ?></a></li>
                                        <li><div class="cats"><i class="fa fa-calendar"></i><?php echo get_blog_category_by_id($data->id); ?></div></li>
                                    </ul>
                                    <p><?php echo e($data->excerpt); ?></p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php if(!empty(get_static_option('about_page_brand_logo_section_status'))): ?>
    <div class="brand-logo-area section-bg-1 padding-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="brand-carousel">
                        <?php $__currentLoopData = $all_brand_logo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="single-carousel">
                                <?php if(!empty($data->url)): ?> <a href="<?php echo e($data->url); ?>"> <?php endif; ?>
                                    <?php echo render_image_markup_by_attachment_id($data->image); ?>

                                <?php if(!empty($data->url)): ?></a> <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/@core/resources/views/frontend/pages/about.blade.php ENDPATH**/ ?>