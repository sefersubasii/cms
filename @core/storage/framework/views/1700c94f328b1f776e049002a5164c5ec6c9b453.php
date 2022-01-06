<?php $__env->startSection('page-title'); ?>
    <?php echo e(get_static_option('gig_page_' . $user_select_lang_slug . '_name')); ?> <?php echo e(__('Order Payment Not Success')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li><a href="<?php echo e(route('frontend.gigs')); ?>"><?php echo e(get_static_option('gig_page_' . $user_select_lang_slug . '_name')); ?></a></li>
    <li><?php echo e(__('Payment not success')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="error-page-content padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-success-area">
                        <h1 class="title"><?php echo e(get_static_option('gig_order_cancel_page_' . $user_select_lang_slug . '_title')); ?></h1>
                        <p><?php echo e(get_static_option('gig_order_cancel_page_' . $user_select_lang_slug . '_description')); ?></p>
                        <div class="btn-wrapper">
                            <a href="<?php echo e(url('/')); ?>" class="boxed-btn"><?php echo e(__('Back To Home')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/beta/@core/resources/views/frontend/pages/gigs/gigs-cancel.blade.php ENDPATH**/ ?>