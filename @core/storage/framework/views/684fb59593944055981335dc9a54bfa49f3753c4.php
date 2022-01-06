<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('About Us Area')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/dropzone.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/media-uploader.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <?php echo $__env->make('backend/partials/message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__('About Us Area Settings')); ?></h4>
                        <form action="<?php echo e(route('admin.homeone.about.us')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <?php $__currentLoopData = get_all_language(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php if($key == 0): ?> active <?php endif; ?>" data-toggle="tab" href="#tab_<?php echo e($key); ?>" role="tab"  aria-selected="true"><?php echo e($lang->name); ?></a>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <div class="tab-content margin-top-30" id="myTabContent">
                                <?php $__currentLoopData = get_all_language(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="tab-pane fade <?php if($key == 0): ?> show active <?php endif; ?>" id="tab_<?php echo e($key); ?>" role="tabpanel" >
                                    <div class="form-group">
                                        <label for="home_page_01_<?php echo e($lang->slug); ?>_about_us_title"><?php echo e(__('Title')); ?></label>
                                        <input type="text" name="home_page_01_<?php echo e($lang->slug); ?>_about_us_title" class="form-control" value="<?php echo e(get_static_option('home_page_01_'.$lang->slug.'_about_us_title')); ?>" id="home_page_01_<?php echo e($lang->slug); ?>_about_us_title">
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_01_<?php echo e($lang->slug); ?>_about_us_description"><?php echo e(__('Description')); ?></label>
                                        <textarea name="home_page_01_<?php echo e($lang->slug); ?>_about_us_description" class="form-control" rows="10" id="home_page_01_<?php echo e($lang->slug); ?>_about_us_description"><?php echo e(get_static_option('home_page_01_'.$lang->slug.'_about_us_description')); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_01_<?php echo e($lang->slug); ?>_about_us_button_status"><strong><?php echo e(__('Button Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_01_<?php echo e($lang->slug); ?>_about_us_button_status"  <?php if(!empty(get_static_option('home_page_01_'.$lang->slug.'_about_us_button_status'))): ?> checked <?php endif; ?> id="home_page_01_<?php echo e($lang->slug); ?>_about_us_button_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_01_<?php echo e($lang->slug); ?>_about_us_button_title"><?php echo e(__('Button Title')); ?></label>
                                        <input type="text" name="home_page_01_<?php echo e($lang->slug); ?>_about_us_button_title" class="form-control" value="<?php echo e(get_static_option('home_page_01_'.$lang->slug.'_about_us_button_title')); ?>" id="home_page_01_<?php echo e($lang->slug); ?>_about_us_button_title">
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_01_<?php echo e($lang->slug); ?>_about_us_button_url"><?php echo e(__('Button URL')); ?></label>
                                        <input type="text" name="home_page_01_<?php echo e($lang->slug); ?>_about_us_button_url" class="form-control" value="<?php echo e(get_static_option('home_page_01_'.$lang->slug.'_about_us_button_url')); ?>" id="home_page_01_<?php echo e($lang->slug); ?>_about_us_button_url">
                                    </div>

                                    <?php if(get_static_option('home_page_variant') == '01' || get_static_option('home_page_variant') == '03'): ?>
                                        <div class="form-group">
                                            <label for="home_page_01_<?php echo e($lang->slug); ?>_about_us_signature_text"><?php echo e(__('Signature Text')); ?></label>
                                            <input type="text" name="home_page_01_<?php echo e($lang->slug); ?>_about_us_signature_text" class="form-control" value="<?php echo e(get_static_option('home_page_01_'.$lang->slug.'_about_us_signature_text')); ?>" id="home_page_01_<?php echo e($lang->slug); ?>_about_us_signature_text">
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo e(__('Signature Image')); ?></label>
                                            <?php $signature_image_upload_btn_label = 'Upload Signature Image'; ?>
                                            <div class="media-upload-btn-wrapper">
                                                <div class="img-wrap">
                                                    <?php
                                                        $signature_img = get_attachment_image_by_id(get_static_option('home_page_01_'.$lang->slug.'_about_us_signature_image'),null,false);
                                                    ?>
                                                    <?php if(!empty($signature_img)): ?>
                                                        <div class="attachment-preview">
                                                            <div class="thumbnail">
                                                                <div class="centered">
                                                                    <img class="avatar user-thumb" src="<?php echo e($signature_img['img_url']); ?>" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php $signature_image_upload_btn_label = 'Change Signature Image'; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <input type="hidden" name="home_page_01_<?php echo e($lang->slug); ?>_about_us_signature_image" value="<?php echo e(get_static_option('home_page_01_'.$lang->slug.'_about_us_signature_image')); ?>">
                                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Signature Image" data-modaltitle="Upload Signature Image" data-imgid="<?php echo e(get_static_option('home_page_01_'.$lang->slug.'_about_us_signature_image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                                    <?php echo e(__($signature_image_upload_btn_label)); ?>

                                                </button>
                                            </div>
                                            <small><?php echo e(__('recommended image size is 100x30 pixel')); ?></small>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(get_static_option('home_page_variant') == '01'): ?>
                                    <div class="form-group">
                                        <label><?php echo e(__('Background Image')); ?></label>
                                        <?php $background_image_upload_btn_label = 'Upload Background Image'; ?>
                                        <div class="media-upload-btn-wrapper">
                                            <div class="img-wrap">
                                                <?php
                                                    $background_img = get_attachment_image_by_id(get_static_option('home_page_01_'.$lang->slug.'_about_us_background_image'),null,false);
                                                ?>
                                                <?php if(!empty($background_img)): ?>
                                                    <div class="attachment-preview">
                                                        <div class="thumbnail">
                                                            <div class="centered">
                                                                <img class="avatar user-thumb" src="<?php echo e($background_img['img_url']); ?>" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php $background_image_upload_btn_label = 'Change Background Image'; ?>
                                                <?php endif; ?>
                                            </div>
                                            <input type="hidden" name="home_page_01_<?php echo e($lang->slug); ?>_about_us_background_image" value="<?php echo e(get_static_option('home_page_01_'.$lang->slug.'_about_us_background_image')); ?>">
                                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Background Image" data-modaltitle="Upload Background Image" data-imgid="<?php echo e(get_static_option('home_page_01_'.$lang->slug.'_about_us_background_image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                                <?php echo e(__($background_image_upload_btn_label)); ?>

                                            </button>
                                        </div>
                                        <small><?php echo e(__('recommended image size is 572x470 pixel')); ?></small>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(get_static_option('home_page_variant') == '02' || get_static_option('home_page_variant') == '04'): ?>
                                        <div class="form-group">
                                            <label><?php echo e(__('Background Image')); ?></label>
                                            <?php $home_02_background_image_upload_btn_label = 'Upload Background Image'; ?>
                                            <div class="media-upload-btn-wrapper">
                                                <div class="img-wrap">
                                                    <?php
                                                        $home_02_background_img = get_attachment_image_by_id(get_static_option('home_page_02_'.$lang->slug.'_about_us_background_image'),null,false);
                                                    ?>
                                                    <?php if(!empty($home_02_background_img)): ?>
                                                        <div class="attachment-preview">
                                                            <div class="thumbnail">
                                                                <div class="centered">
                                                                    <img class="avatar user-thumb" src="<?php echo e($home_02_background_img['img_url']); ?>" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php $home_02_background_image_upload_btn_label = 'Change Background Image'; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <input type="hidden" name="home_page_02_<?php echo e($lang->slug); ?>_about_us_background_image" value="<?php echo e(get_static_option('home_page_02_'.$lang->slug.'_about_us_background_image')); ?>">
                                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Background Image" data-modaltitle="Upload Background Image" data-imgid="<?php echo e(get_static_option('home_page_02_'.$lang->slug.'_about_us_background_image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                                    <?php echo e(__($home_02_background_image_upload_btn_label)); ?>

                                                </button>
                                            </div>
                                            <small><?php echo e(__('recommended image size is 1920x575 pixel')); ?></small>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(get_static_option('home_page_variant') == '03'): ?>
                                        <div class="form-group">
                                            <label><?php echo e(__('Right Image')); ?></label>
                                            <?php $home_01_right_image_upload_btn_label = 'Upload Right Image'; ?>
                                            <div class="media-upload-btn-wrapper">
                                                <div class="img-wrap">
                                                    <?php
                                                        $home_01_right_img = get_attachment_image_by_id(get_static_option('home_page_01_'.$lang->slug.'_about_us_right_image'),null,false);
                                                    ?>
                                                    <?php if(!empty($home_01_right_img)): ?>
                                                        <div class="attachment-preview">
                                                            <div class="thumbnail">
                                                                <div class="centered">
                                                                    <img class="avatar user-thumb" src="<?php echo e($home_01_right_img['img_url']); ?>" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php $home_01_right_image_upload_btn_label = 'Change Right Image'; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <input type="hidden" name="home_page_01_<?php echo e($lang->slug); ?>_about_us_right_image" value="<?php echo e(get_static_option('home_page_01_'.$lang->slug.'_about_us_right_image')); ?>">
                                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Right Image" data-modaltitle="Upload Right Image" data-imgid="<?php echo e(get_static_option('home_page_01_'.$lang->slug.'_about_us_right_image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                                    <?php echo e(__($home_01_right_image_upload_btn_label)); ?>

                                                </button>
                                            </div>
                                            <small><?php echo e(__('recommended image size is 690x1190 pixel')); ?></small>
                                        </div>

                                        <div class="form-group">
                                            <label for="home_page_01_<?php echo e($lang->slug); ?>_about_us_quote_box_title"><?php echo e(__('Quote Box Title')); ?></label>
                                            <input type="text" name="home_page_01_<?php echo e($lang->slug); ?>_about_us_quote_box_title" class="form-control" value="<?php echo e(get_static_option('home_page_01_'.$lang->slug.'_about_us_quote_box_title')); ?>" id="home_page_01_<?php echo e($lang->slug); ?>_about_us_quote_box_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="home_page_01_<?php echo e($lang->slug); ?>_about_us_quote_box_description"><?php echo e(__('Quote Box Description')); ?></label>
                                            <textarea name="home_page_01_<?php echo e($lang->slug); ?>_about_us_quote_box_description" class="form-control" rows="10" id="home_page_01_<?php echo e($lang->slug); ?>_about_us_quote_box_description"><?php echo e(get_static_option('home_page_01_'.$lang->slug.'_about_us_quote_box_description')); ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="home_page_01_<?php echo e($lang->slug); ?>_about_us_experience_title"><?php echo e(__('Experience Title')); ?></label>
                                            <input type="text" name="home_page_01_<?php echo e($lang->slug); ?>_about_us_experience_title" class="form-control" value="<?php echo e(get_static_option('home_page_01_'.$lang->slug.'_about_us_experience_title')); ?>" id="home_page_01_<?php echo e($lang->slug); ?>_about_us_experience_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="home_page_01_<?php echo e($lang->slug); ?>_about_us_experience_year"><?php echo e(__('Experience Year')); ?></label>
                                            <input type="text" name="home_page_01_<?php echo e($lang->slug); ?>_about_us_experience_year" class="form-control" value="<?php echo e(get_static_option('home_page_01_'.$lang->slug.'_about_us_experience_year')); ?>" id="home_page_01_<?php echo e($lang->slug); ?>_about_us_experience_year">
                                        </div>
                                        <div class="form-group">
                                            <label ><?php echo e(__('Experience Background Image')); ?></label>
                                            <?php $home_01_experience_background_image_upload_btn_label = 'Upload Experience Background Image'; ?>
                                            <div class="media-upload-btn-wrapper">
                                                <div class="img-wrap">
                                                    <?php
                                                        $home_01_experience_background_img = get_attachment_image_by_id(get_static_option('home_page_01_'.$lang->slug.'_about_us_experience_background_image'),null,false);
                                                    ?>
                                                    <?php if(!empty($home_01_experience_background_img)): ?>
                                                        <div class="attachment-preview">
                                                            <div class="thumbnail">
                                                                <div class="centered">
                                                                    <img class="avatar user-thumb" src="<?php echo e($home_01_experience_background_img['img_url']); ?>" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php $home_01_experience_background_image_upload_btn_label = 'Change Experience Background Image'; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <input type="hidden" name="home_page_01_<?php echo e($lang->slug); ?>_about_us_experience_background_image" value="<?php echo e(get_static_option('home_page_01_'.$lang->slug.'_about_us_experience_background_image')); ?>">
                                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Experience Background Image" data-modaltitle="Upload Experience Background Image" data-imgid="<?php echo e(get_static_option('home_page_01_'.$lang->slug.'_about_us_experience_background_image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                                    <?php echo e(__($home_01_experience_background_image_upload_btn_label)); ?>

                                                </button>
                                            </div>
                                            <small><?php echo e(__('recommended image size is 270x310 pixel')); ?></small>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Settings')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('backend.partials.media-upload.media-upload-markup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/backend/js/dropzone.js')); ?>"></script>
    <?php echo $__env->make('backend.partials.media-upload.media-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/@core/resources/views/backend/pages/home/home-01/about-us.blade.php ENDPATH**/ ?>