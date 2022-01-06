<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Testimonial Area')); ?>

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
                        <h4 class="header-title"><?php echo e(__('Testimonial Area Settings')); ?></h4>
                        <form action="<?php echo e(route('admin.homeone.testimonial')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php if(get_static_option('home_page_variant') != '03'): ?>
                            <div class="form-group">
                                <label for="home_01_testimonial_bg"><?php echo e(__('Background Image')); ?></label>
                                <?php $signature_image_upload_btn_label = 'Upload Background Image'; ?>
                                <?php echo e(get_static_option('home_01_testimonial_bg')); ?>

                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        <?php
                                            $signature_img = get_attachment_image_by_id(get_static_option('home_01_testimonial_bg'),null,false);
                                        ?>
                                        <?php if(!empty($signature_img)): ?>
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered">
                                                        <img class="avatar user-thumb" src="<?php echo e($signature_img['img_url']); ?>" >
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $signature_image_upload_btn_label = 'Change Background Image'; ?>
                                        <?php endif; ?>
                                    </div>
                                    <input type="hidden" name="home_01_testimonial_bg" value="<?php echo e(get_static_option('home_01_testimonial_bg')); ?>">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Background Image" data-modaltitle="Upload Background Image" data-imgid="<?php echo e(get_static_option('home_01_testimonial_bg')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                        <?php echo e(__($signature_image_upload_btn_label)); ?>

                                    </button>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if(get_static_option('home_page_variant') == '03'): ?>
                            <div class="form-group">
                                <label for="home_01_testimonial_bg"><?php echo e(__('Background Image')); ?></label>
                                <?php $home_03_image_upload_btn_label = 'Upload Background Image'; ?>
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        <?php
                                            $home_03_img = get_attachment_image_by_id(get_static_option('home_03_testimonial_bg'),null,false);
                                        ?>
                                        <?php if(!empty($home_03_img)): ?>
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered">
                                                        <img class="avatar user-thumb" src="<?php echo e($home_03_img['img_url']); ?>" >
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $home_03_image_upload_btn_label = 'Change Background Image'; ?>
                                        <?php endif; ?>
                                    </div>
                                    <input type="hidden" name="home_03_testimonial_bg" value="<?php echo e(get_static_option('home_03_testimonial_bg')); ?>">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Background Image" data-modaltitle="Upload Background Image" data-imgid="<?php echo e(get_static_option('home_03_testimonial_bg')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                        <?php echo e(__($home_03_image_upload_btn_label)); ?>

                                    </button>
                                </div>
                            </div>
                            <?php endif; ?>
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
<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/@core/resources/views/backend/pages/home/home-01/testimonial.blade.php ENDPATH**/ ?>