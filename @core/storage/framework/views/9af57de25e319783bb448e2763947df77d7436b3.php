<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Video Area')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/dropzone.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/media-uploader.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/summernote-bs4.css')); ?>">
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
                        <h4 class="header-title"><?php echo e(__('Video Area Settings')); ?></h4>
                        <form action="<?php echo e(route('admin.service.home.video.area')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label><?php echo e(__('Background Image')); ?></label>
                                <?php $background_image_upload_btn_label = 'Upload Image'; ?>
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        <?php
                                            $background_img = get_attachment_image_by_id(get_static_option('home_page_06_video_area_background_image'),null,false);
                                        ?>
                                        <?php if(!empty($background_img)): ?>
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered">
                                                        <img class="avatar user-thumb" src="<?php echo e($background_img['img_url']); ?>" >
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $background_image_upload_btn_label = 'Change Image'; ?>
                                        <?php endif; ?>
                                    </div>
                                    <input type="hidden" name="home_page_06_video_area_background_image" value="<?php echo e(get_static_option('home_page_06_video_area_background_image')); ?>">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Image" data-modaltitle="Upload Image" data-imgid="<?php echo e(get_static_option('home_page_06_video_area_background_image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                        <?php echo e(__($background_image_upload_btn_label)); ?>

                                    </button>
                                </div>
                                <small><?php echo e(__('recommended image size is 1070x560 pixel')); ?></small>
                            </div>
                           <div class="form-group">
                               <label for="home_page_06_video_area_video_url"><?php echo e(__('Video Url')); ?></label>
                               <input type="text" class="form-control" name="home_page_06_video_area_video_url" id="home_page_06_video_area_video_url" value="<?php echo e(get_static_option('home_page_06_video_area_video_url')); ?>">
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
    <script src="<?php echo e(asset('assets/backend/js/summernote-bs4.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/dropzone.js')); ?>"></script>
    <?php echo $__env->make('backend.partials.media-upload.media-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/@core/resources/views/backend/pages/home/service-home/video-area.blade.php ENDPATH**/ ?>