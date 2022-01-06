<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Service Single Settings')); ?>

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
                        <h4 class="header-title"><?php echo e(__('Service Single Settings')); ?></h4>
                        <form action="<?php echo e(route('admin.services.single.page.settings')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a class="nav-item nav-link <?php if($key == 0): ?> active <?php endif; ?>" data-toggle="tab" href="#nav-home-<?php echo e($lang->slug); ?>" role="tab"  aria-selected="true"><?php echo e($lang->name); ?></a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </nav>
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="tab-pane fade <?php if($key == 0): ?> show active <?php endif; ?>" id="nav-home-<?php echo e($lang->slug); ?>" role="tabpanel">
                                    <div class="form-group">
                                        <label for="service_single_page_<?php echo e($lang->slug); ?>_category_title"><?php echo e(__('Category Title')); ?></label>
                                        <input type="text" name="service_single_page_<?php echo e($lang->slug); ?>_category_title" value="<?php echo e(get_static_option('service_single_page_'.$lang->slug.'_category_title')); ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="service_single_page_<?php echo e($lang->slug); ?>_recent_services_title"><strong><?php echo e(__('Recent Services')); ?></strong></label>
                                        <input type="text" class="form-control" name="service_single_page_<?php echo e($lang->slug); ?>_recent_services_title" value="<?php echo e(get_static_option('service_single_page_'.$lang->slug.'_recent_services_title')); ?>">

                                    </div>
                                    <div class="form-group">
                                        <label for="service_single_page_<?php echo e($lang->slug); ?>_search_placeholder_text"><?php echo e(__('Search Placeholder Text')); ?></label>
                                        <input type="text" name="service_single_page_<?php echo e($lang->slug); ?>_search_placeholder_text" value="<?php echo e(get_static_option('service_single_page_'.$lang->slug.'_search_placeholder_text')); ?>" class="form-control" >
                                    </div>
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

<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/@core/resources/views/backend/pages/service/service-single-settings.blade.php ENDPATH**/ ?>