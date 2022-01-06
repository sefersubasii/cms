<div class="header-style-07">
    <nav class="navbar navbar-area navbar-expand-lg nav-style-event-home home-variant-<?php echo e(get_static_option('home_page_variant')); ?>">
        <div class="container nav-container">
            <div class="responsive-mobile-menu">
                <div class="logo-wrapper">
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
                <div class="nav-right-content">
                    <ul>
                        <li class="btn-wrapper" >
                            <?php $quote_btn_url = !empty(get_static_option('navbar_button_custom_url_status')) ? get_static_option('navbar_button_custom_url') : route('frontend.request.quote'); ?>
                            <a href="<?php echo e($quote_btn_url); ?>" class="boxed-btn"><?php echo e(get_static_option('navbar_'.$user_select_lang_slug.'_button_text')); ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/beta/@core/resources/views/frontend/partials/navbar-06.blade.php ENDPATH**/ ?>