<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Gig order message')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li><a href="<?php echo e(route('user.home')); ?>"><?php echo e(__('User Dashboard')); ?></a></li>
    <li> <?php echo e(__('Gig order message')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/media-uploader.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/summernote-bs4.css')); ?>">

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="login-page-wrapper padding-top-120 padding-bottom-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="gig-chat-message-wrap">
                        <a href="<?php echo e(route('user.home')); ?>" class="anchor-btn margin-bottom-30"><?php echo e(__('Back to dashboard')); ?></a>
                        <div class="gig-chat-message-heading">
                            <div class="gig-order-info">
                                <ul>
                                    <li><strong><?php echo e(__('Order ID:')); ?></strong> #<?php echo e($gig_details->id); ?></li>
                                    <li><strong><?php echo e(__('Gig Name:')); ?></strong> <?php echo e(get_gig_name($gig_details->gig_id)); ?></li>
                                    <li><strong><?php echo e(__('Package Name:')); ?></strong> <?php echo e($gig_details->selected_plan_title); ?></li>
                                    <li><strong><?php echo e(__('Package Price:')); ?></strong> <?php echo e(amount_with_currency_symbol($gig_details->selected_plan_price)); ?></li>
                                    <li><strong><?php echo e(__('Revisions:')); ?></strong> <span class="alert-success"><?php echo e($gig_details->selected_plan_revisions.' '.__('Time Revisions')); ?></span></li>
                                    <li><strong><?php echo e(__('Payment Gateway:')); ?></strong> <?php echo e(str_replace('_',' ',$gig_details->selected_payment_gateway)); ?></li>
                                    <li><strong><?php echo e(__('Payment Status:')); ?></strong> <span class="<?php if($gig_details->payment_status == 'complete'): ?> alert-success <?php else: ?> alert-warning <?php endif; ?>"><?php echo e(ucwords($gig_details->payment_status)); ?></span></li>
                                    <li><strong><?php echo e(__('Order Status:')); ?></strong> <span class="<?php if($gig_details->order_status == 'complete'): ?> alert-success <?php else: ?> alert-info <?php endif; ?>"><?php echo e(ucwords(str_replace('_',' ',$gig_details->order_status))); ?> </span></li>
                                    <li><strong><?php echo e(__('Delivery Date:')); ?></strong> <span class="alert-danger"><?php echo e(get_future_date($gig_details->created_at,$gig_details->selected_plan_delivery_days)); ?></span></li>
                                </ul>
                            </div>
                            <div class="delivery-time-countdown-wrap">
                                <h2 class="title"><?php echo e(__("Delivery time countdown")); ?></h2>
                                <div class="countdown-wrapper">
                                    <div id="countdown"></div>
                                </div>
                            </div>
                            <div class="gig-message-start-wrap">
                                <h2 class="title"><?php echo e(__('All Conversation')); ?></h2>

                                <div class="single-message-item ">
                                   <div class="top-part">
                                       <div class="thumb">
                                           <span class="title"><?php echo e(substr(get_username_by_id($gig_details->user_id),0,1)); ?></span>
                                           <i class="fas fa-envelope" title="<?php echo e(__('Notified by email')); ?>"></i>
                                       </div>
                                       <div class="content">
                                           <h6 class="title"><?php echo e(get_username_by_id($gig_details->user_id)); ?></h6>
                                           <span class="time"><?php echo e(date_format($gig_details->created_at,'d M Y H:i:s')); ?></span>
                                       </div>
                                   </div>
                                    <div class="content">
                                        <span class="span_title"><?php echo e(__('Message')); ?></span>
                                        <p><?php echo e($gig_details->message); ?></p>
                                        <span class="span_title"><?php echo e(__('Additional Note')); ?></span>
                                        <p><?php echo e($gig_details->additional_note); ?></p>
                                        <?php if(file_exists('assets/uploads/gig-files/'.$gig_details->file)): ?>
                                        <span class="span_title"><?php echo e(__('Attached File')); ?></span>
                                        <a href="<?php echo e(asset('assets/uploads/gig-files/'.$gig_details->file)); ?>" download class="anchor-btn"><?php echo e($gig_details->file); ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <?php if(!empty($gig_message)): ?>
                                    <div class="all-message-wrap <?php if($q == 'all'): ?> msg-row-reverse <?php endif; ?>">
                                    <?php if($q == 'all' && count($gig_message) > 1): ?>
                                        <form action="" method="get">
                                            <input type="hidden" value="all" name="q">
                                            <button class="load_all_conversation" type="submit"><?php echo e(__('load all message')); ?></button>
                                        </form>
                                    <?php endif; ?>
                                    <?php $__currentLoopData = $gig_message; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="single-message-item <?php if($msg->user_type == 'admin'): ?> customer <?php endif; ?>">
                                            <div class="top-part">
                                                <div class="thumb">
                                                    <span class="title">
                                                         <?php if($msg->user_type == 'customer'): ?>
                                                            <?php echo e(substr(get_username_by_id($msg->user_id),0,1)); ?>

                                                        <?php else: ?>
                                                            <?php echo e(substr(get_username_by_admin_id($msg->user_id),0,1)); ?>

                                                        <?php endif; ?>
                                                    </span>
                                                    <?php if($msg->notify_mail == 'yes'): ?>
                                                    <i class="fas fa-envelope" title="<?php echo e(__('Notified by email')); ?>"></i>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="content">
                                                    <h6 class="title">
                                                        <?php if($msg->user_type == 'customer'): ?>
                                                            <?php echo e(get_username_by_id($msg->user_id)); ?>

                                                        <?php else: ?>
                                                            <?php echo e(get_username_by_admin_id($msg->user_id)); ?>

                                                        <?php endif; ?>
                                                    </h6>
                                                    <span class="time"><?php echo e(date_format($msg->created_at,'d M Y H:i:s')); ?> | <?php echo e($msg->created_at->diffForHumans()); ?></span>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <div class="message-content">
                                                    <?php echo $msg->message; ?>

                                                </div>
                                                <?php if(file_exists('assets/uploads/gig-files/'.$msg->file)): ?>
                                                    <a href="<?php echo e(asset('assets/uploads/gig-files/'.$msg->file)); ?>" download class="anchor-btn"><?php echo e($msg->file); ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="reply-message-wrap ">
                                <h5 class="title"><?php echo e(__('Replay To Message')); ?></h5>
                                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php if($errors->any()): ?>
                                    <div class="alert alert-danger">
                                        <ul>
                                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($error); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                                <form action="<?php echo e(route('user.home.gig.new.message')); ?>" method="post" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" value="<?php echo e($gig_details->id); ?>" name="gig_order_id">
                                    <input type="hidden" value="customer" name="user_type">
                                    <div class="form-group">
                                        <label for=""><?php echo e(__('Message')); ?></label>
                                        <textarea name="message" class="form-control" style="display: none;" cols="30" rows="5" ></textarea>
                                        <div class="summernote"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="file"><?php echo e(__('File')); ?></label>
                                        <input type="file" name="file" accept="zip">
                                        <small class="info-text d-block text-danger"><?php echo e(__('max file size 200mb, only zip file is allowed')); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="send_notify_mail" id="send_notify_mail">
                                        <label for="send_notify_mail"><?php echo e(__('Notify Via Mail')); ?></label>
                                    </div>
                                    <button class="boxed-btn" type="submit"><?php echo e(__('Send Message')); ?></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/backend/js/summernote-bs4.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/common/js/countdown.jquery.js')); ?>"></script>
    <script>
        $(document).ready(function(){

            $('.summernote').summernote({
                height: 200,   //set editable area's height
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ],
                codemirror: { // codemirror options
                    theme: 'default'
                },
                callbacks: {
                    onChange: function(contents, $editable) {
                        $(this).prev('textarea').val(contents);
                    }
                }
            });

            var year = "<?php echo e(date('Y',strtotime(get_future_date($gig_details->created_at,$gig_details->selected_plan_delivery_days)))); ?>";
            var month = "<?php echo e(date('m',strtotime(get_future_date($gig_details->created_at,$gig_details->selected_plan_delivery_days)))); ?>";
            var day = "<?php echo e(date('d',strtotime(get_future_date($gig_details->created_at,$gig_details->selected_plan_delivery_days)))); ?>";
            var hours = "<?php echo e(date('h',strtotime(get_future_date($gig_details->created_at,$gig_details->selected_plan_delivery_days)))); ?>";
            var min = "<?php echo e(date('i',strtotime(get_future_date($gig_details->created_at,$gig_details->selected_plan_delivery_days)))); ?>";
            var sec = "<?php echo e(date('s',strtotime(get_future_date($gig_details->created_at,$gig_details->selected_plan_delivery_days)))); ?>";
            if (year) {
                $('#countdown').countdown({
                    year: year,
                    month: month,
                    day: day,
                    hour: hours,
                    minute: min,
                    second: sec,
                    labels: true,
                    labelText: {
                        'days': "<?php echo e(__('days')); ?>",
                        'hours': "<?php echo e(__('hours')); ?>",
                        'minutes': "<?php echo e(__('min')); ?>",
                        'seconds': "<?php echo e(__('sec')); ?>",
                    }
                });
            }

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/beta/@core/resources/views/frontend/user/dashboard/gig-order-message.blade.php ENDPATH**/ ?>