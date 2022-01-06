<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('News Area')); ?>

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
                        <h4 class="header-title"><?php echo e(__('News Area Settings')); ?></h4>
                        <form action="<?php echo e(route('admin.service.home.news.area')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php if($key == 0): ?> active <?php endif; ?>" data-toggle="tab" href="#tab_<?php echo e($key); ?>" role="tab"  aria-selected="true"><?php echo e($lang->name); ?></a>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <div class="tab-content margin-top-30" id="myTabContent">
                                <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="tab-pane fade <?php if($key == 0): ?> show active <?php endif; ?>" id="tab_<?php echo e($key); ?>" role="tabpanel" >
                                    <div class="form-group">
                                        <label for="home_page_06_<?php echo e($lang->slug); ?>_news_area_title"><?php echo e(__('Title')); ?></label>
                                        <input type="text" name="home_page_06_<?php echo e($lang->slug); ?>_news_area_title" class="form-control" value="<?php echo e(get_static_option('home_page_06_'.$lang->slug.'_news_area_title')); ?>" >
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_06_<?php echo e($lang->slug); ?>_news_area_description"><?php echo e(__('Description')); ?></label>
                                        <textarea name="home_page_06_<?php echo e($lang->slug); ?>_news_area_description" class="form-control" cols="30" rows="10"><?php echo e(get_static_option('home_page_06_'.$lang->slug.'_news_area_description')); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_06_<?php echo e($lang->slug); ?>_news_area_read_more_text"><?php echo e(__('Read More Text')); ?></label>
                                        <input type="text" name="home_page_06_<?php echo e($lang->slug); ?>_news_area_read_more_text" class="form-control" value="<?php echo e(get_static_option('home_page_06_'.$lang->slug.'_news_area_read_more_text')); ?>" >
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="form-group">
                                <label for="home_06_news_area_background_image"><?php echo e(__('Background Image')); ?> </label>
                                <?php $signature_image_upload_btn_label = 'Upload Background Image'; ?>
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        <?php echo render_attachment_preview(get_static_option('home_06_news_area_background_image')); ?>

                                        <?php
                                            $signature_img = get_attachment_image_by_id(get_static_option('home_06_news_area_background_image'),null,false);
                                        ?>
                                        <?php if(!empty($signature_img)): ?>
                                            <?php $signature_image_upload_btn_label = 'Change Background Image'; ?>
                                        <?php endif; ?>
                                    </div>
                                    <input type="hidden" name="home_06_news_area_background_image" value="<?php echo e(get_static_option('home_06_news_area_background_image')); ?>">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Background Image" data-modaltitle="Upload Background Image" data-imgid="<?php echo e(get_static_option('home_06_news_area_background_image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                        <?php echo e(__($signature_image_upload_btn_label)); ?>

                                    </button>
                                </div>
                                <small><?php echo e(__('recommended image size is 1920x300 pixel')); ?></small>
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
<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/@core/resources/views/backend/pages/home/service-home/news-area.blade.php ENDPATH**/ ?>