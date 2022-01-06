<?php $__env->startSection('site-title'); ?>
    <?php echo e(get_static_option('site_'.$user_select_lang_slug.'_title')); ?> - <?php echo e(get_static_option('site_'.$user_select_lang_slug.'_tag_line')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Flutterwave Payment')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <style>
        .stripe-payment-wrapper form {
            width: 500px;
        }
        .stripe-payment-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100%;
        }
        .stripe-payment-wrapper h1 {
            font-family: var(--heading-font);
            font-size: 40px;
            line-height: 50px;
            width: 500px;
            text-align: center;
            margin-bottom: 40px;
        }

        .srtipe-payment-inner-wrapper {
            box-shadow: 0 0 35px 0 rgba(0,0,0,0.1);
            padding: 40px;
            display: inline-block;
        }

        .srtipe-payment-inner-wrapper label {
            font-size: 16px;
            color: var(--paragraph-color);
            margin-bottom: 10px;
            line-height: 26px;
        }

        .srtipe-payment-inner-wrapper .razorpay-payment-button {
            display: block;
            border: none;
            background-color: var(--main-color-one);
            padding: 13px 30px;
            border-radius: 3px;
            font-size: 16px;
            line-height: 26px;
            font-weight: 600;
            color: #fff;
            margin-top: 30px;
            cursor: pointer;
            width: 180px;
            margin: 0 auto;
        }
        .srtipe-payment-inner-wrapper .razorpay-payment-button:focus{
            outline: none;
            box-shadow: none;
        }
        .srtipe-payment-inner-wrapper img {
            max-width: 300px;
            margin: 0 auto;
            display: block;
        }
        input.submit-btn {
            display: inline-block;
            background-color: var(--main-color-one);
            padding: 10px 40px;
            width: auto;
            color: #fff;
        }

        input.submit-btn:hover {
            background-color: var(--main-color-two);
            color: #fff;
        }
        .srtipe-payment-inner-wrapper .razorpay-payment-button[disabled]{
            background-color: #bdb3b3;cursor: not-allowed;
        }
        .srtipe-payment-inner-wrapper .notice {
            text-align: center;
            color: #d82435;
            margin-bottom: 30px;
            background-color: #ffd0d0;
            padding: 10px;
        }
        input.submit-btn:hover {
            background-color: var(--secondary-color);
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="stripe-payment-wrapper padding-top-120 padding-bottom-120">
        <div class="srtipe-payment-inner-wrapper">
            <?php echo render_image_markup_by_attachment_id(get_static_option('flutterwave_preview_logo')); ?>

            <div class="notice" style="display: none;"><?php echo e(__('Do not close or reload the page...')); ?></div>
            <form method="POST" action="<?php echo e($flutterwave_data['form_action']); ?>" id="paymentForm">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="amount" value="<?php echo e($flutterwave_data['amount']); ?>" /> <!-- Replace the value with your transaction amount -->
                <input type="hidden" name="payment_method" value="both" /> <!-- Can be card, account, both -->
                <input type="hidden" name="description" value="<?php echo e($flutterwave_data['description']); ?>" /> <!-- Replace the value with your transaction description -->
                <input type="hidden" name="country" value="<?php echo e($flutterwave_data['country']); ?>" /> <!-- Replace the value with your transaction country -->
                <input type="hidden" name="currency" value="<?php echo e($flutterwave_data['currency']); ?>" /> <!-- Replace the value with your transaction currency -->
                <input type="hidden" name="email" value="<?php echo e($flutterwave_data['email']); ?>" /> <!-- Replace the value with your customer email -->
                <input type="hidden" name="firstname" value="<?php echo e($flutterwave_data['name']); ?>" /> <!-- Replace the value with your customer firstname -->

                <input type="hidden" name="metadata" value="<?php echo e(json_encode($flutterwave_data['metadata'])); ?>" > <!-- Meta data that might be needed to be passed to the Rave Payment Gateway -->

                <div class="btn-wrapper text-center">
                    <input type="submit" class="submit-btn" value="<?php echo e(__('Pay '.$flutterwave_data['amount'].get_charge_currency('flutterwave').' Now')); ?>"  />
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function (){
            $(document).on('click','.submit-btn',function (e){
                var submitBtn = $(this);
                // submitBtn.attr('disabled',true);
                submitBtn.val('Please Wait...');
                $('.notice').css('display','block');
            });

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/beta/@core/resources/views/frontend/payment/flutterwave.blade.php ENDPATH**/ ?>