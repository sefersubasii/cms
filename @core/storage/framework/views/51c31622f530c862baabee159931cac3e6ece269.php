
<div class="header-knowledebase-area"
<?php echo render_background_image_markup_by_attachment_id(get_static_option('home_page_05_header_background_image')); ?>

>
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
    <?php echo $__env->make('frontend.partials.navbar-04', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="header-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="header-inner">
                        <h1 class="title"><?php echo e(get_static_option('home_page_05_'.$user_select_lang_slug.'_header_title')); ?></h1>
                        <p><?php echo e(get_static_option('home_page_05_'.$user_select_lang_slug.'_header_description')); ?></p>
                        <?php if(!empty(get_static_option('home_page_05_'.$user_select_lang_slug.'_search_form_status'))): ?>
                            <div class="search-wrapper">
                                <form action="<?php echo e(route('frontend.knowledgebase.search')); ?>" method="get">
                                    <input type="text" class="form-control" name="search" placeholder="<?php echo e(get_static_option('home_page_05_'.$user_select_lang_slug.'_header_search_placeholder')); ?>">
                                    <button class="search-btn" type="submit"><i class="fas fa-search"></i></button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom-image-wrap">
        <?php echo render_image_markup_by_attachment_id(get_static_option('home_page_05_header_bottom_image')); ?>

    </div>
</div>
<?php if(!empty(get_static_option('knowledgebase_home_page_highlight_box_section_status'))): ?>
<div class="highlight-area padding-top-120 padding-bottom-120">
    <div class="container">
        <div class="row">
            <?php
                $all_icon_fields =  get_static_option('home_page_05_highlight_box_icon');
                $all_icon_fields = !empty($all_icon_fields) ? unserialize($all_icon_fields) : [];
                 $all_title_fields = get_static_option('home_page_05_'.$user_select_lang_slug.'_highlight_box_title');
                $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [];
                $all_description_fields = get_static_option('home_page_05_'.$user_select_lang_slug.'_highlight_box_description');
                $all_description_fields = !empty($all_description_fields) ? unserialize($all_description_fields) : [];
            ?>
            <?php if(!empty($all_icon_fields)): ?>
            <?php $__currentLoopData = $all_icon_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $icon_field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4">
                <div class="single-highlight-item">
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
<?php if(!empty(get_static_option('knowledgebase_home_page_popular_article_section_status'))): ?>
<div class="popular-article-area padding-bottom-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-50">
                    <h2 class="title"><?php echo e(get_static_option('home_page_05_'.$user_select_lang_slug.'_popular_article_title')); ?></h2>
                    <p><?php echo e(get_static_option('home_page_05_'.$user_select_lang_slug.'_popular_article_description')); ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php $__currentLoopData = $popular_article; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4">
                <div class="single-popular-article-wrap">
                    <h4 class="title"><a href="<?php echo e(route('frontend.knowledgebase.category',['id' => $key, 'any' => Str::slug(get_knowledgebase_topic($key))])); ?>"><?php echo e(get_knowledgebase_topic($key)); ?></a></h4>
                    <ul class="article-list">
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><i class="fas fa-file-alt"></i> <a href="<?php echo e(route('frontend.knowledgebase.single',$item->title)); ?>"><?php echo e($item->title); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(get_static_option('knowledgebase_home_page_testimonial_section_status'))): ?>
<div class="knowledge-testimonial-area padding-top-120 padding-bottom-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="testimonial-carousel-wrapper">
                    <?php $__currentLoopData = $all_testimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="single-testimonial-item-05">
                        <p><?php echo e($data->description); ?></p>
                        <div class="author-details">
                            <div class="thumb">
                                <?php echo render_image_markup_by_attachment_id($data->image); ?>

                            </div>
                            <div class="author">
                                <h4 class="title"><?php echo e($data->name); ?></h4>
                                <span class="designation"><?php echo e($data->designation); ?></span>
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
<?php if(!empty(get_static_option('knowledgebase_home_page_faq_section_status'))): ?>
<div class="faq-area-wrapper padding-top-120 padding-bottom-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-50">
                    <h2 class="title"><?php echo e(get_static_option('home_page_05_'.$user_select_lang_slug.'_faq_area_title')); ?></h2>
                    <p><?php echo e(get_static_option('home_page_05_'.$user_select_lang_slug.'_faq_area_description')); ?></p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion-wrapper">
                    <?php $rand_number = rand(9999,99999999); ?>
                    <div id="accordion_<?php echo e($rand_number); ?>">
                        <?php $__currentLoopData = $all_faq; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $aria_expanded = 'false';
                                if($data->is_open == 'on'){ $aria_expanded = 'true'; }
                            ?>
                            <div class="card">
                                <div class="card-header" id="headingOne_<?php echo e($key); ?>">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse" data-target="#collapseOne_<?php echo e($key); ?>" role="button"
                                           aria-expanded="<?php echo e($aria_expanded); ?>" aria-controls="collapseOne_<?php echo e($key); ?>">
                                            <?php echo e($data->title); ?>

                                        </a>
                                    </h5>
                                </div>

                                <div id="collapseOne_<?php echo e($key); ?>" class="collapse <?php if($data->is_open == 'on'): ?> show <?php endif; ?> "
                                     aria-labelledby="headingOne_<?php echo e($key); ?>" data-parent="#accordion_<?php echo e($rand_number); ?>">
                                    <div class="card-body">
                                        <?php echo e($data->description); ?>

                                    </div>
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
<?php if(!empty(get_static_option('knowledgebase_home_page_team_section_status'))): ?>
<div class="team-member-area padding-bottom-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-50">
                    <h2 class="title"><?php echo e(get_static_option('home_page_01_'.$user_select_lang_slug.'_team_member_section_title')); ?></h2>
                    <p><?php echo e(get_static_option('home_page_01_'.$user_select_lang_slug.'_team_member_section_description')); ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="team-member-carousel">
                    <?php $__currentLoopData = $all_team_members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="single-team-member">
                        <div class="thumb">
                            <?php echo render_image_markup_by_attachment_id($data->image,'','grid'); ?>

                        </div>
                        <div class="content">
                            <h4 class="title"><?php echo e($data->name); ?></h4>
                            <span class="designation"><?php echo e($data->designation); ?></span>
                            <ul class="social">
                                <?php if(!empty($data->icon_one) && !empty($data->icon_one_url)): ?>
                                    <li><a href="<?php echo e($data->icon_one_url); ?>"><i class="<?php echo e($data->icon_one); ?>"></i></a></li>
                                <?php endif; ?>
                                <?php if(!empty($data->icon_two) && !empty($data->icon_two_url)): ?>
                                    <li><a href="<?php echo e($data->icon_two_url); ?>"><i class="<?php echo e($data->icon_two); ?>"></i></a></li>
                                <?php endif; ?>
                                <?php if(!empty($data->icon_three) && !empty($data->icon_three_url)): ?>
                                    <li><a href="<?php echo e($data->icon_three_url); ?>"><i class="<?php echo e($data->icon_three); ?>"></i></a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(get_static_option('knowledgebase_home_page_cta_section_status'))): ?>
<div class="call-to-action-wrapper padding-bottom-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cta-inner-wrapper"
                <?php echo render_background_image_markup_by_attachment_id(get_static_option('home_page_05_cta_area_background_image')); ?>

                >
                    <div class="left-content-wrap">
                        <h2 class="title"><?php echo e(get_static_option('home_page_05_'.$user_select_lang_slug.'_cta_area_title')); ?></h2>
                        <p><?php echo e(get_static_option('home_page_05_'.$user_select_lang_slug.'_cta_area_description')); ?></p>
                    </div>
                    <div class="btn-wrpper">
                        <a href="<?php echo e(get_static_option('home_page_05_cta_area_btn_url')); ?>" class="boxed-btn"><?php echo e(get_static_option('home_page_05_'.$user_select_lang_slug.'_cta_area_btn_text')); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/@core/resources/views/frontend/home-pages/home-05.blade.php ENDPATH**/ ?>