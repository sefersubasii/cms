<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Gig Page Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Gig Page Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.gigs.page.settings')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="gig_page_items"><?php echo e(__('Order Button Title')); ?></label>
                                <input type="number" name="gig_page_items"  class="form-control" value="<?php echo e(get_static_option('gig_page_items')); ?>" >
                            </div>
                            <div class="form-group">
                                <label for="gig_page_notify_email"><?php echo e(__('Gig Notify Email')); ?></label>
                                <input type="text" name="gig_page_notify_email"  class="form-control" value="<?php echo e(get_static_option('gig_page_notify_email')); ?>" >
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/@core/resources/views/backend/gigs/gig-page-settings.blade.php ENDPATH**/ ?>