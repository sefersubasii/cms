<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Order Success')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li><a href="<?php echo e(route('frontend.gigs')); ?>"><?php echo e(get_static_option('gig_page_' . $user_select_lang_slug . '_name')); ?></a></li>
    <li><?php echo e(__('Order Success')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="error-page-content padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="gig-order-success-page-wrap">
                        <div class="description">
                            <h4>
                                <?php
                                $gig_title = get_static_option('gig_order_success_page_'.$user_select_lang_slug.'_title');
                                ?>
                                <?php echo e(str_replace('[id]','#'.$gig_order_details->id,$gig_title)); ?>

                            </h4>
                        </div>
                        <div class="gigs-info-wrap">
                            <div class="billing-info-wrap">
                                <ul>
                                    <li><strong><?php echo e(get_static_option('gig_order_success_page_'.$user_select_lang_slug.'_gig_name_title')); ?>:</strong> <?php echo e(get_gig_name($gig_order_details->gig_id)); ?></li>
                                    <li><strong><?php echo e(get_static_option('gig_order_success_page_'.$user_select_lang_slug.'_gig_order_date_text')); ?>:</strong> <?php echo e(date_format($gig_order_details->created_at,'d M Y')); ?></li>
                                    <li><strong><?php echo e(get_static_option('gig_order_success_page_'.$user_select_lang_slug.'_gig_order_delivery_date_text')); ?>:</strong> <?php echo e(get_future_date($gig_order_details->created_at,$gig_order_details->selected_plan_delivery_days)); ?></li>
                                    <li><strong><?php echo e(get_static_option('gig_order_success_page_'.$user_select_lang_slug.'_gig_total_revisions_text')); ?>:</strong> <?php echo e($gig_order_details->selected_plan_revisions); ?> <?php echo e(__('Time Revisions')); ?></li>
                                    <li><strong><?php echo e(get_static_option('gig_order_success_page_'.$user_select_lang_slug.'_gig_payment_gateway_text')); ?>:</strong> <?php echo e(ucwords(str_replace('_',' ',$gig_order_details->selected_payment_gateway))); ?></li>
                                    <li><strong><?php echo e(get_static_option('gig_order_success_page_'.$user_select_lang_slug.'_gig_payment_status_text')); ?>:</strong> <?php echo e($gig_order_details->payment_status); ?></li>
                                </ul>
                            </div>
                            <div class="gig-price-plan order-page">
                                <h2><?php echo e(get_static_option('gig_order_success_page_'.$user_select_lang_slug.'_gig_ordered_plan_text')); ?></h2>
                                <h4 class="title"><?php echo e($gig_order_details->selected_plan_title); ?></h4>
                                <div class="price-wrap">
                                    <?php echo e(amount_with_currency_symbol($gig_order_details->selected_plan_price)); ?>

                                </div>
                                <?php
                                    $gig_details = \App\Gig::find($gig_order_details->gig_id);
                                    $all_plan_features = !empty($gig_details->features) ? unserialize($gig_details->features) : [];
                                    $all_plan_description = !empty($gig_details->plan_description) ? unserialize($gig_details->plan_description) : [];
                                    $selected_plan_features = explode("\n",$all_plan_features[$gig_order_details->selected_plan_index]);
                                ?>

                                <div class="description">
                                    <p><?php echo e($all_plan_description[$gig_order_details->selected_plan_index]); ?></p>
                                </div>

                                <ul class="feature-list">
                                    <?php $__currentLoopData = $selected_plan_features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($item); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>

                                <div class="revision-wrapper">
                                    <span class="delivery-time"><i class="far fa-clock"></i> <?php echo e($gig_order_details->selected_plan_delivery_days); ?> <?php echo e(__('Days Delivery')); ?></span>
                                    <span class="revisions"><i class="fas fa-sync"></i> <?php echo e($gig_order_details->selected_plan_revisions); ?> <?php echo e(__('Time Revisions')); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="btn-wrapper margin-top-40">
                            <a href="<?php echo e(route('user.home')); ?>" class="boxed-btn"><?php echo e(__('Go to Dashboard')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/beta/@core/resources/views/frontend/pages/gigs/gigs-success.blade.php ENDPATH**/ ?>