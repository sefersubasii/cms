<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Gig Single Page Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Gig Single Page Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.gigs.single.page.settings')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a class="nav-item nav-link <?php if($key == 0): ?> active <?php endif; ?>" id="nav-home-tab" data-toggle="tab" href="#nav-home-<?php echo e($lang->slug); ?>" role="tab" aria-controls="nav-home" aria-selected="true"><?php echo e($lang->name); ?></a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </nav>
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="tab-pane fade <?php if($key == 0): ?> show active <?php endif; ?>" id="nav-home-<?php echo e($lang->slug); ?>" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="form-group">
                                            <label for="gig_single_<?php echo e($lang->slug); ?>_order_button_title"><?php echo e(__('Order Button Title')); ?></label>
                                            <input type="text" name="gig_single_<?php echo e($lang->slug); ?>_order_button_title"  class="form-control" value="<?php echo e(get_static_option('gig_single_'.$lang->slug.'_order_button_title')); ?>" >
                                        </div>
                                        <div class="form-group">
                                            <label for="gig_single_<?php echo e($lang->slug); ?>_quote_title"><?php echo e(__('Quote Title')); ?></label>
                                            <input type="text" name="gig_single_<?php echo e($lang->slug); ?>_quote_title"  class="form-control" value="<?php echo e(get_static_option('gig_single_'.$lang->slug.'_quote_title')); ?>" >
                                        </div>
                                        <div class="form-group">
                                            <label for="gig_single_<?php echo e($lang->slug); ?>_quote_button_title"><?php echo e(__('Quote Button Title')); ?></label>
                                            <input type="text" name="gig_single_<?php echo e($lang->slug); ?>_quote_button_title"  class="form-control" value="<?php echo e(get_static_option('gig_single_'.$lang->slug.'_quote_button_title')); ?>" >
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/beta/@core/resources/views/backend/gigs/gig-single-page-settings.blade.php ENDPATH**/ ?>