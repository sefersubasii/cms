<?php $__env->startSection('og-meta'); ?>
    <meta property="og:url"  content="<?php echo e(route('frontend.donations.single',$donation->slug)); ?>" />
    <meta property="og:type"  content="article" />
    <meta property="og:title"  content="<?php echo e($donation->meta_title ?? $donation->title); ?>" />
    <?php echo render_og_meta_image_by_attachment_id($donation->image); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e($donation->meta_title ?? $donation->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e($donation->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e($donation->meta_tags); ?>">
    <meta name="tags" content="<?php echo e($donation->meta_description); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li><?php echo e($donation->title); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('edit_link'); ?>
    <li><a href="<?php echo e(route('admin.donations.edit',$donation->id)); ?>"><i class="far fa-edit"></i> <?php echo e(__('Edit Donation')); ?></a></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="donation-content-area padding-top-120 padding-bottom-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="contribute-single-item">
                        <div class="thumb">
                            <?php echo render_image_markup_by_attachment_id($donation->image,'','large'); ?>

                            <div class="thumb-content">
                                <div class="progress-item">
                                    <div class="single-progressbar">
                                        <div class="donation-progress" data-percent="<?php echo e(get_percentage($donation->amount,$donation->raised)); ?>"></div>
                                    </div>
                                </div>
                                <div class="goal">
                                    <h4 class="raised"><?php echo e(get_static_option('donation_raised_'.$user_select_lang_slug.'_text')); ?> <?php echo e(site_currency_symbol()); ?><?php echo e($donation->raised ? $donation->raised : 0); ?></h4>
                                    <h4 class="raised"><?php echo e(get_static_option('donation_goal_'.$user_select_lang_slug.'_text')); ?> <?php echo e(site_currency_symbol()); ?><?php echo e($donation->amount); ?></h4>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <div class="donation-goal">

                            </div>
                            <div class="details-content-area">
                                <?php echo $donation->donation_content; ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area">
                        <div class="donation_wrapper">
                            <h3 class="title"><?php echo e(get_static_option('donation_single_'.$user_select_lang_slug.'_form_title')); ?></h3>
                            <div class="single_amount_wrapper">
                                <?php
                                    $custom_amounts  =  get_static_option('donation_custom_amount');
                                    $custom_amounts = !empty($custom_amounts) ? explode(',',$custom_amounts) : [5,10,15,20];
                                ?>
                                <?php $__currentLoopData = $custom_amounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="single_amount" data-value="<?php echo e(trim($amount)); ?>"><?php echo e(site_currency_symbol().$amount); ?></div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                             <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.error-msg','data' => []]); ?>
<?php $component->withName('error-msg'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                            <form action="<?php echo e(route('frontend.donations.log.store')); ?>" method="post" enctype="multipart/form-data" class="donation-form-wrapper">
                                <?php echo csrf_field(); ?>
                                 <input type="hidden" name="captcha_token" id="gcaptcha_token">
                                <div class="amount_wrapper">
                                    <div class="suffix"><?php echo e(site_currency_symbol()); ?></div>
                                    <input type="hidden" name="donation_id" value="<?php echo e($donation->id); ?>" >
                                    <input type="number" name="amount" value="<?php echo e(trim(get_static_option('donation_default_amount'))); ?>" step="1" min="1">
                                </div>
                                <?php
                                    $email_value = auth()->guard('web')->check() ? auth()->guard('web')->user()->email : '';
                                    $name_value = auth()->guard('web')->check() ? auth()->guard('web')->user()->name : '';
                                ?>

                                <div class="form-group">
                                    <div class="label"><?php echo e(__('Name')); ?></div>
                                    <input type="text" name="name" class="form-control" placeholder="<?php echo e(__('Name')); ?>" value="<?php echo e($name_value); ?>">
                                </div>
                                <div class="form-group">
                                    <div class="label"><?php echo e(__('Email')); ?></div>
                                    <input type="text" name="email" class="form-control" placeholder="<?php echo e(__('Email')); ?>" value="<?php echo e($email_value); ?>">
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="donation_type" name="donation_type">
                                    <label class="form-check-label" for="donation_type"><?php echo e(__('Donate Anonymously')); ?></label>
                                </div>
                                <?php echo render_payment_gateway_for_form(); ?>

                                <?php if(!empty(get_static_option('manual_payment_gateway'))): ?>
                                <div class="form-group manual_payment_transaction_field <?php if(get_static_option('site_default_payment_gateway') == 'manual_payment'): ?> show <?php endif; ?>">
                                    <div class="label"><?php echo e(__('Transaction ID')); ?></div>
                                    <input type="text" name="transaction_id" placeholder="<?php echo e(__('transaction')); ?>" class="form-control">
                                    <span class="help-info"><?php echo get_manual_payment_description(); ?></span>
                                </div>
                                <?php endif; ?>
                                <button class="donation-btn btn-boxed style-01" type="submit"><?php echo e(get_static_option('donation_single_'.$user_select_lang_slug.'_form_button_text')); ?></button>
                            </form>
                        </div>
                        <div class="donated_people margin-bottom-30">
                            <h3 class="title"><?php echo e(get_static_option('donation_single_'.$user_select_lang_slug.'_recently_donated_title')); ?></h3>
                            <?php if(count($all_donations) > 0): ?>
                            <ul class="recently-donated-list">
                                <?php $__currentLoopData = $all_donations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="single-donor-info">
                                    <div class="icon-wrap">
                                        <img src="<?php echo e(asset('assets/frontend/icons/donation.svg')); ?>" alt="">
                                    </div>
                                    <div class="content">
                                        <h4 class="title"><?php if($data->donation_type == 'on'): ?> <?php echo e(__('Anonymous')); ?> <?php else: ?> <?php echo e($data->name); ?> <?php endif; ?></h4>
                                        <div class="bottom-content">
                                            <span class="amount"><?php echo e(amount_with_currency_symbol($data->amount)); ?></span>
                                            <span class="dated-time"><?php echo e(date_format($data->created_at,'d M y h:m:s')); ?></span>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <?php else: ?>
                                <div class="alert alert-warning"><?php echo e(__('no recent donation found')); ?></div>
                            <?php endif; ?>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php if(!empty(get_static_option('site_google_captcha_v3_site_key'))): ?>
    <script
        src="https://www.google.com/recaptcha/api.js?render=<?php echo e(get_static_option('site_google_captcha_v3_site_key')); ?>"></script>
    <script>
        grecaptcha.ready(function () {
            grecaptcha.execute("<?php echo e(get_static_option('site_google_captcha_v3_site_key')); ?>", {action: 'homepage'}).then(function (token) {
                document.getElementById('gcaptcha_token').value = token;
            });
        });
    </script>
<?php endif; ?>
    <script src="<?php echo e(asset('assets/frontend/js/jQuery.rProgressbar.min.js')); ?>"></script>
    <script>
        (function($) {
            'use strict';
            var allProgress =  $('.donation-progress');
            $.each(allProgress,function (index, value) {
                $(this).rProgressbar({
                    percentage: $(this).data('percent'),
                    fillBackgroundColor: "<?php echo e(get_static_option('site_color')); ?>"
                });
            })
            /*------------------------------
                donate activation
            -------------------------------*/

            $(document).on('click', '.donation_wrapper .single_amount', function(e) {
                e.preventDefault();
                $('input[name="amount"]').val($(this).data('value'));
            });

            var defaulGateway = $('#site_global_payment_gateway').val();
            $('.payment-gateway-wrapper ul li[data-gateway="'+defaulGateway+'"]').addClass('selected');

            $(document).on('click','.payment-gateway-wrapper > ul > li',function (e) {
                e.preventDefault();
                var gateway = $(this).data('gateway');
                if(gateway == 'manual_payment'){
                    $('.manual_payment_transaction_field').addClass('show');
                }else{
                    $('.manual_payment_transaction_field').removeClass('show');
                }
                $(this).addClass('selected').siblings().removeClass('selected');
                $('.payment-gateway-wrapper').find(('input')).val(gateway);
            });

        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/sharifur/Desktop/sharifur-backup/localhost/dizzcox/@core/resources/views/frontend/pages/donations/donation-single.blade.php ENDPATH**/ ?>