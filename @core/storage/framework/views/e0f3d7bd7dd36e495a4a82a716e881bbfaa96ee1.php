<?php $__env->startSection('site-title'); ?>
    <?php echo e(get_static_option('gig_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(get_static_option('gig_page_'.$user_select_lang_slug.'_name')); ?> <?php echo e(__('Order')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e(get_static_option('gig_page_'.$user_select_lang_slug.'_meta_description')); ?>">
    <meta name="tags" content="<?php echo e(get_static_option('gig_page_'.$user_select_lang_slug.'_meta_tags')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li><a href="<?php echo e(route('frontend.gigs')); ?>"><?php echo e(get_static_option('gig_page_'.$user_select_lang_slug.'_name')); ?></a></li>
    <li><?php echo e(get_static_option('gig_page_'.$user_select_lang_slug.'_name')); ?> <?php echo e(__('Order')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="blog-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <?php if(!auth()->check()): ?>
                        <div class="login-form gig-page">
                            <h4><?php echo e(__('login to continue order')); ?></h4>
                            <form action="<?php echo e(route('user.login')); ?>" method="post" enctype="multipart/form-data" class="account-form" id="login_form_order_page">
                                <?php echo csrf_field(); ?>
                                <div class="error-wrap"></div>
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control" placeholder="<?php echo e(__('Username')); ?>">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="<?php echo e(__('Password')); ?>">
                                </div>
                                <div class="form-group btn-wrapper">
                                    <button type="submit" id="login_btn" class="submit-btn"><?php echo e(__('Login')); ?></button>
                                </div>
                                <div class="row mb-4 rmber-area">
                                    <div class="col-6">
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" name="remember" class="custom-control-input" id="remember">
                                            <label class="custom-control-label" for="remember"><?php echo e(__('Remember Me')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-6 text-right">
                                        <a class="d-block" href="<?php echo e(route('user.register')); ?>"><?php echo e(__('Haven\'t any account?')); ?></a>
                                        <a href="<?php echo e(route('user.forget.password')); ?>"><?php echo e(__('Forgot Password?')); ?></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php else: ?>
                        <?php if($errors->any()): ?>
                            <ul class="alert alert-danger">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php endif; ?>
                        <form action="<?php echo e(route('frontend.gigs.order.new')); ?>" method="post" enctype="multipart/form-data" class="gig_order_form">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="gig_id" value="<?php echo e($gig_details->id); ?>">
                            <input type="hidden" name="selected_plan_index" value="<?php echo e($index_id); ?>">
                            <input type="hidden" name="selected_plan_revisions" value="<?php echo e($plan_details['revisions']); ?>">
                            <input type="hidden" name="selected_plan_delivery_days" value="<?php echo e($plan_details['delivery_time']); ?>">
                            <input type="hidden" name="selected_plan_price" value="<?php echo e($plan_details['price']); ?>">
                            <input type="hidden" name="selected_plan_title" value="<?php echo e($plan_details['title']); ?>">
                            <div class="form-group">
                                <label for="full_name"><?php echo e(__('Full Name')); ?></label>
                                <input type="text" class="form-control" name="full_name" value="<?php echo e(auth()->user()->name); ?>">
                            </div>
                            <div class="form-group">
                                <label for="email"><?php echo e(__('Email')); ?></label>
                                <input type="text" class="form-control" name="email" value="<?php echo e(auth()->user()->email); ?>">
                            </div>
                            <div class="form-group">
                                <label for="file" class="d-block"><?php echo e(__('File')); ?></label>
                                <input type="file" accept=".zip" name="file">
                                <small class="help-text d-block text-danger"><?php echo e(__('only zip file is allowed, max: 250mb allowed')); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="message"><?php echo e(__('Message')); ?></label>
                                <textarea name="message" class="form-control" cols="10" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="additional_note"><?php echo e(__('Addition Note')); ?></label>
                                <textarea name="additional_note" class="form-control" cols="10" rows="5"></textarea>
                            </div>
                            <?php echo render_payment_gateway_for_form(); ?>

                            <?php if(!empty(get_static_option('manual_payment_gateway'))): ?>
                                <div class="form-group manual_payment_transaction_field">
                                    <div class="label"><?php echo e(__('Transaction ID')); ?></div>
                                    <input type="text" name="transaction_id" placeholder="<?php echo e(__('transaction')); ?>" class="form-control">
                                    <span class="help-info"><?php echo get_manual_payment_description(); ?></span>
                                </div>
                            <?php endif; ?>
                            <button type="submit" class="boxed-btn"><?php echo e(__('Place Order')); ?></button>
                        </form>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4">
                    <div class="gigs-info-wrap">
                        <div class="gig-price-plan order-page">
                            <h4 class="title"><?php echo e(strtolower($plan_details['title'])); ?></h4>
                            <div class="price-wrap">
                                <?php echo e(amount_with_currency_symbol($plan_details['price'])); ?>

                            </div>
                            <div class="description">
                                <p><?php echo e($plan_details['description']); ?></p>
                            </div>
                            <ul class="feature-list">
                                <?php $featuers = !empty($plan_details['features']) ? explode("\n",$plan_details['features']) : []; ?>
                                <?php $__currentLoopData = $featuers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($item); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <div class="revision-wrapper">
                                <span class="delivery-time"><i class="far fa-clock"></i> <?php echo e($plan_details['delivery_time']); ?> <?php echo e(__('Days Delivery')); ?></span>
                                <span class="revisions"><i class="fas fa-sync"></i> <?php echo e($plan_details['revisions']); ?> <?php echo e(__('Time Revisions')); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        (function () {
            "use strict";

            $(document).on('click', '#login_btn', function (e) {
                e.preventDefault();
                var formContainer = $('#login_form_order_page');
                var el = $(this);
                var username = formContainer.find('input[name="username"]').val();
                var password = formContainer.find('input[name="password"]').val();
                var remember = formContainer.find('input[name="remember"]').val();

                el.text('Please Wait');

                $.ajax({
                    type: 'post',
                    url: "<?php echo e(route('user.ajax.login')); ?>",
                    data: {
                        _token: "<?php echo e(csrf_token()); ?>",
                        username : username,
                        password : password,
                        remember : remember,
                    },
                    success: function (data){
                        if(data.status == 'invalid'){
                            el.text('Login')
                            formContainer.find('.error-wrap').html('<div class="alert alert-danger">'+data.msg+'</div>');
                        }else{
                            formContainer.find('.error-wrap').html('');
                            el.text('Login Success.. Redirecting ..');
                            location.reload();
                        }
                    },
                    error: function (data){
                        var response = data.responseJSON.errors
                        formContainer.find('.error-wrap').html('<ul class="alert alert-danger"></ul>');
                        $.each(response,function (value,index){
                            formContainer.find('.error-wrap ul').append('<li>'+value+'</li>');
                        });
                        el.text('Login');
                    }
                });
            });

            $(document).on('click','.payment-gateway-wrapper > ul > li',function (e) {
                e.preventDefault();
                var gateway = $(this).data('gateway');
                $(this).addClass('selected').siblings().removeClass('selected');
                $('input[name="selected_payment_gateway"]').val(gateway);
                if(gateway == 'manual_payment'){
                    $('.manual_payment_transaction_field').addClass('show');
                }else{
                    $('.manual_payment_transaction_field').removeClass('show');
                }
            });

        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/beta/@core/resources/views/frontend/pages/gigs/gigs-order.blade.php ENDPATH**/ ?>