<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Work Single Page Settings')); ?>

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
                        <h4 class="header-title"><?php echo e(__('Work Single Page Settings')); ?></h4>
                        <form action="<?php echo e(route('admin.work.single.page.settings')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a class="nav-item nav-link <?php if($key == 0): ?> active <?php endif; ?>"  data-toggle="tab" href="#nav-home-<?php echo e($lang->slug); ?>" role="tab" aria-selected="true"><?php echo e($lang->name); ?></a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </nav>
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="tab-pane fade <?php if($key ==0): ?> show active <?php endif; ?>" id="nav-home-<?php echo e($lang->slug); ?>" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="form-group">
                                            <label for="work_single_page_<?php echo e($lang->slug); ?>_related_work_title"><?php echo e(__('Related Work Title')); ?></label>
                                            <input type="text" name="work_single_page_<?php echo e($lang->slug); ?>_related_work_title" value="<?php echo e(get_static_option('work_single_page_'.$lang->slug.'_related_work_title')); ?>" class="form-control" id="work_single_page_<?php echo e($lang->slug); ?>_related_work_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="work_single_page_<?php echo e($lang->slug); ?>_sidebar_title"><?php echo e(__('Sidebar Title')); ?></label>
                                            <input type="text" name="work_single_page_<?php echo e($lang->slug); ?>_sidebar_title" value="<?php echo e(get_static_option('work_single_page_'.$lang->slug.'_sidebar_title')); ?>" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label for="work_single_page_<?php echo e($lang->slug); ?>_start_date_text"><?php echo e(__('Start Date Text')); ?></label>
                                            <input type="text" name="work_single_page_<?php echo e($lang->slug); ?>_start_date_text" value="<?php echo e(get_static_option('work_single_page_'.$lang->slug.'_start_date_text')); ?>" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label for="work_single_page_<?php echo e($lang->slug); ?>_end_date_text"><?php echo e(__('End Date Text')); ?></label>
                                            <input type="text" name="work_single_page_<?php echo e($lang->slug); ?>_end_date_text" value="<?php echo e(get_static_option('work_single_page_'.$lang->slug.'_end_date_text')); ?>" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label for="work_single_page_<?php echo e($lang->slug); ?>_clients_text"><?php echo e(__('Clients Text')); ?></label>
                                            <input type="text" name="work_single_page_<?php echo e($lang->slug); ?>_clients_text" value="<?php echo e(get_static_option('work_single_page_'.$lang->slug.'_clients_text')); ?>" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label for="work_single_page_<?php echo e($lang->slug); ?>_category_text"><?php echo e(__('Category Text')); ?></label>
                                            <input type="text" name="work_single_page_<?php echo e($lang->slug); ?>_category_text" value="<?php echo e(get_static_option('work_single_page_'.$lang->slug.'_category_text')); ?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="work_single_page_<?php echo e($lang->slug); ?>_share_text"><?php echo e(__('Share Text')); ?></label>
                                            <input type="text" name="work_single_page_<?php echo e($lang->slug); ?>_share_text" value="<?php echo e(get_static_option('work_single_page_'.$lang->slug.'_share_text')); ?>" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label for="work_single_page_<?php echo e($lang->slug); ?>_gallery_title"><?php echo e(__('Gallery Title')); ?></label>
                                            <input type="text" name="work_single_page_<?php echo e($lang->slug); ?>_gallery_title" value="<?php echo e(get_static_option('work_single_page_'.$lang->slug.'_gallery_title')); ?>" class="form-control" >
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

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/@core/resources/views/backend/pages/works/work-single-page-settings.blade.php ENDPATH**/ ?>