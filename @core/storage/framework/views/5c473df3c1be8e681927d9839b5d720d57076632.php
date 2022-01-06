<?php if(!empty(get_static_option('home_page_support_bar_section_status'))): ?>
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

<div class="info-bar-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="info-bar-inner">
                    <div class="logo-wrapper desktop-logo">
                        <a href="<?php echo e(url('/')); ?>" class="logo">
                            <?php echo render_image_markup_by_attachment_id(get_static_option('site_logo')); ?>

                        </a>
                    </div>
                    <div class="right-content">
                        <ul class="info-items">
                            <?php $__currentLoopData = $all_support_item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <div class="single-info-item">
                                        <div class="icon">
                                            <i class="<?php echo e($data->icon); ?>"></i>
                                        </div>
                                        <div class="content">
                                            <h5 class="title"><?php echo e($data->title); ?></h5>
                                            <span class="details"><?php echo e($data->details); ?></span>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>

                        <div class="request-quote">
                            <?php $quote_btn_url = !empty(get_static_option('navbar_button_custom_url_status')) ? get_static_option('navbar_button_custom_url') : route('frontend.request.quote'); ?>
                            <a href="<?php echo e($quote_btn_url); ?>" class="rq-btn"><?php echo e(get_static_option('top_bar_'.$user_select_lang_slug.'_button_text')); ?></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-area navbar-expand-lg nav-style-01">
    <div class="container nav-container">
        <div class="responsive-mobile-menu">
            <div class="logo-wrapper mobile-logo">
                <a href="<?php echo e(url('/')); ?>" class="logo">
                    <?php echo render_image_markup_by_attachment_id(get_static_option('site_logo')); ?>

                </a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bizcoxx_main_menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="bizcoxx_main_menu">
            <ul class="navbar-nav">
                <?php echo render_menu_by_id($primary_menu_id); ?>

            </ul>
        </div>
    </div>
</nav><?php /**PATH /Users/dvrobin/Desktop/Sharifur-Backup/localhost/bizzcox/@core/resources/views/frontend/partials/navbar-01.blade.php ENDPATH**/ ?>