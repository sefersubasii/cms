<!DOCTYPE html>
<html lang="<?php echo e(get_user_lang()); ?>"  dir="<?php echo e(get_user_lang_direction()); ?>">
<head>
    <?php if(!empty(get_static_option('site_google_analytics'))): ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e(get_static_option('site_google_analytics')); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', "<?php echo e(get_static_option('site_google_analytics')); ?>");
    </script>
    <?php endif; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="<?php echo e(get_static_option('site_meta_description')); ?>">
    <meta name="tags" content="<?php echo e(get_static_option('site_meta_tags')); ?>">

    <?php echo render_favicon_by_id(get_static_option('site_favicon')); ?>

    <!-- load fonts dynamically -->
    <?php echo load_google_fonts(); ?>

    <!-- all stylesheets -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/fontawesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/animate.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/flaticon.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/fonts/xg-flaticon.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/magnific-popup.css')); ?>">
    <link rel="stylesheet"  href="<?php echo e(asset('assets/frontend/css/style.css')); ?>">
    <?php if(get_static_option('home_page_variant') == '10'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/jobs-home.css')); ?>">
    <?php endif; ?>
    <?php if(get_static_option('home_page_variant') == '05'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/knowledgebase-home.css')); ?>">
    <?php endif; ?>
    <?php if(get_static_option('home_page_variant') == '06'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/service-home.css')); ?>">
    <?php endif; ?>
    <?php if(get_static_option('home_page_variant') == '09'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/charity-home.css')); ?>">
    <?php endif; ?>
    <?php if(get_static_option('home_page_variant') == '07'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/event-home.css')); ?>">
    <?php endif; ?>
    <?php if(get_static_option('home_page_variant') == '08'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/product-home.css')); ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/responsive.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/dynamic-style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/jquery.ihavecookies.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/toastr.css')); ?>">

        <style>
        :root {
            --main-color-one: <?php echo e(get_static_option('site_color')); ?>;
            --secondary-color: <?php echo e(get_static_option('site_main_color_two')); ?>;
            --service-color: <?php echo e(get_static_option('service_site_color')); ?>;
            --knowledge-color: <?php echo e(get_static_option('knowledgebase_site_color')); ?>;
            --event-color: <?php echo e(get_static_option('event_site_color')); ?>;
            --charity-color: <?php echo e(get_static_option('charity_site_color')); ?>;
            --heading-color: <?php echo e(get_static_option('site_heading_color')); ?>;
            --paragraph-color: <?php echo e(get_static_option('site_paragraph_color')); ?>;
            <?php $heading_font_family = !empty(get_static_option('heading_font')) ? get_static_option('heading_font_family') :  get_static_option('body_font_family') ?>
            --heading-font: "<?php echo e($heading_font_family); ?>",sans-serif;
            --body-font:"<?php echo e(get_static_option('body_font_family')); ?>",sans-serif;
        }
    </style>

    <?php echo $__env->yieldContent('style'); ?>
    <?php if(!empty(get_static_option('site_rtl_enabled')) || get_user_lang_direction() == 'rtl'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/rtl.css')); ?>">
    <?php endif; ?>
    <?php echo $__env->yieldContent('og-meta'); ?>
    <?php if(request()->is(get_static_option('about_page_slug')) || request()->is(get_static_option('service_page_slug')) || request()->is(get_static_option('product_page_slug').'-cart') || request()->is(get_static_option('product_page_slug')) || request()->is(get_static_option('work_page_slug')) || request()->is(get_static_option('team_page_slug')) || request()->is(get_static_option('faq_page_slug')) || request()->is(get_static_option('blog_page_slug')) || request()->is(get_static_option('contact_page_slug')) || request()->is('p/*') || request()->is(get_static_option('blog_page_slug').'/*') || request()->is(get_static_option('service_page_slug').'/*') || request()->is(get_static_option('career_with_us_page_slug').'/*') || request()->is(get_static_option('events_page_slug').'/*') || request()->is(get_static_option('knowledgebase_page_slug').'/*')  || request()->is(get_static_option('product_page_slug').'/*')  || request()->is(get_static_option('donation_page_slug').'/*')): ?>
        <title><?php echo $__env->yieldContent('site-title'); ?> - <?php echo e(get_static_option('site_'.$user_select_lang_slug.'_title')); ?> </title>
    <?php else: ?>
        <title><?php echo e(get_static_option('site_'.$user_select_lang_slug.'_title')); ?> - <?php echo e(get_static_option('site_'.$user_select_lang_slug.'_tag_line')); ?></title>
    <?php endif; ?>
    <?php echo get_static_option('site_header_script'); ?>

</head>
<body class="dizzcox_version_<?php echo e(getenv('XGENIOUS_DIZCOXX_VERSION')); ?> <?php echo e(get_static_option('item_license_status')); ?> apps_key_<?php echo e(getenv('XGENIOUS_API_KEY')); ?> ">
<?php echo $__env->make('frontend.partials.preloader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if(auth()->guard('admin')->check()): ?>
    <div class="dizzcox_admin_bar">
        <div class="left-content-part">
            <ul class="admin-links">
                <li><a href="<?php echo e(route('admin.home')); ?>"><i class="fas fa-tachometer-alt"></i> <?php echo e(__('Dashboard')); ?></a></li>
                <li><a href="<?php echo e(route('admin.general.site.identity')); ?>"><i class="fas fa-sliders-h"></i> <?php echo e(__('General Settings')); ?></a></li>
                <li><a href="<?php echo e(route('admin.menu')); ?>"><i class="fas fa-bars"></i> <?php echo e(__('Menu Edit')); ?></a></li>
                <?php echo $__env->yieldContent('edit_link'); ?>
            </ul>
        </div>
        <div class="right-content-part">
            <div class="author-details-wrap">
                <h6><?php echo e(auth()->guard('admin')->user()->name); ?></h6>
                <div class="author-link">
                    <a href="<?php echo e(route('admin.profile.update')); ?>"><?php echo e(__('Edit Profile')); ?></a>
                    <a href="<?php echo e(route('admin.password.change')); ?>"><?php echo e(__('Password Change')); ?></a>
                    <a href="<?php echo e(route('admin.logout')); ?>"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <?php echo e(__('Logout')); ?>

                    </a>
                    <form id="logout-form" action="<?php echo e(route('admin.logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>


<?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/beta/@core/resources/views/frontend/partials/header.blade.php ENDPATH**/ ?>