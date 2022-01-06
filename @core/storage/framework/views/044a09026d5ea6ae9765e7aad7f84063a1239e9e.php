<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Gig Success Page Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Gig Success Page Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.gigs.success.page.settings')); ?>" method="POST" enctype="multipart/form-data">
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
                                            <label for="gig_order_success_page_<?php echo e($lang->slug); ?>_title"><?php echo e(__('Title')); ?></label>
                                            <input type="text" name="gig_order_success_page_<?php echo e($lang->slug); ?>_title"  class="form-control" value="<?php echo e(get_static_option('gig_order_success_page_'.$lang->slug.'_title')); ?>" >
                                            <small class="info-help"><?php echo e(__('[id] will be replaced by order id')); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="gig_order_success_page_<?php echo e($lang->slug); ?>_gig_name_title"><?php echo e(__('Gig Name Text')); ?></label>
                                            <input type="text" name="gig_order_success_page_<?php echo e($lang->slug); ?>_gig_name_title"  class="form-control" value="<?php echo e(get_static_option('gig_order_success_page_'.$lang->slug.'_gig_name_title')); ?>" >
                                        </div>
                                        <div class="form-group">
                                            <label for="gig_order_success_page_<?php echo e($lang->slug); ?>_gig_order_date_text"><?php echo e(__('Order Date Text')); ?></label>
                                            <input type="text" name="gig_order_success_page_<?php echo e($lang->slug); ?>_gig_order_date_text"  class="form-control" value="<?php echo e(get_static_option('gig_order_success_page_'.$lang->slug.'_gig_order_date_text')); ?>" >
                                        </div>
                                        <div class="form-group">
                                            <label for="gig_order_success_page_<?php echo e($lang->slug); ?>_gig_order_delivery_date_text"><?php echo e(__('Order Delivery Date Text')); ?></label>
                                            <input type="text" name="gig_order_success_page_<?php echo e($lang->slug); ?>_gig_order_delivery_date_text"  class="form-control" value="<?php echo e(get_static_option('gig_order_success_page_'.$lang->slug.'_gig_order_delivery_date_text')); ?>" >
                                        </div>
                                        <div class="form-group">
                                            <label for="gig_order_success_page_<?php echo e($lang->slug); ?>_gig_total_revisions_text"><?php echo e(__('Total Revision Text')); ?></label>
                                            <input type="text" name="gig_order_success_page_<?php echo e($lang->slug); ?>_gig_total_revisions_text"  class="form-control" value="<?php echo e(get_static_option('gig_order_success_page_'.$lang->slug.'_gig_total_revisions_text')); ?>" >
                                        </div>
                                        <div class="form-group">
                                            <label for="gig_order_success_page_<?php echo e($lang->slug); ?>_gig_payment_gateway_text"><?php echo e(__('Payment Gateway Text')); ?></label>
                                            <input type="text" name="gig_order_success_page_<?php echo e($lang->slug); ?>_gig_payment_gateway_text"  class="form-control" value="<?php echo e(get_static_option('gig_order_success_page_'.$lang->slug.'_gig_payment_gateway_text')); ?>" >
                                        </div>
                                        <div class="form-group">
                                            <label for="gig_order_success_page_<?php echo e($lang->slug); ?>_gig_payment_status_text"><?php echo e(__('Payment Status Text')); ?></label>
                                            <input type="text" name="gig_order_success_page_<?php echo e($lang->slug); ?>_gig_payment_status_text"  class="form-control" value="<?php echo e(get_static_option('gig_order_success_page_'.$lang->slug.'_gig_payment_status_text')); ?>" >
                                        </div>
                                        <div class="form-group">
                                            <label for="gig_order_success_page_<?php echo e($lang->slug); ?>_gig_ordered_plan_text"><?php echo e(__('Ordered Plan Text')); ?></label>
                                            <input type="text" name="gig_order_success_page_<?php echo e($lang->slug); ?>_gig_ordered_plan_text"  class="form-control" value="<?php echo e(get_static_option('gig_order_success_page_'.$lang->slug.'_gig_ordered_plan_text')); ?>" >
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

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/beta/@core/resources/views/backend/gigs/gig-success-page-settings.blade.php ENDPATH**/ ?>