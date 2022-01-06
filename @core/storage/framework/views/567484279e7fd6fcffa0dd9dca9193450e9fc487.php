<?php $__env->startSection('site-title'); ?>
    <?php echo e(get_static_option('site_'.get_default_language().'_title')); ?> - <?php echo e(get_static_option('site_'.get_default_language().'_tag_line')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('PayStack Payment')); ?>

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
        .srtipe-payment-inner-wrapper .razorpay-payment-button[disabled]{
            background-color: #bdb3b3;cursor: not-allowed;
        }
        .srtipe-payment-inner-wrapper .notice {
            text-align: center;
            color: #d82435;
            margin-top: 30px;
            background-color: #ffd0d0;
            padding: 10px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="stripe-payment-wrapper padding-top-120 padding-bottom-120">
        <div class="srtipe-payment-inner-wrapper">
            <?php echo render_image_markup_by_attachment_id(get_static_option('paystack_preview_logo')); ?>

            <div class="notice" style="display: none;"><?php echo e(__('Do not close or reload the page...')); ?></div>
            <form method="POST" action="<?php echo e($paystack_data['route']); ?>" accept-charset="UTF-8" class="form-horizontal" role="form">
                <?php echo csrf_field(); ?>
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <input type="hidden" name="name" value="<?php echo e($paystack_data['name']); ?>">
                        <input type="hidden" name="email" value="<?php echo e($paystack_data['email']); ?>"> 
                        <input type="hidden" name="order_id" value="<?php echo e($paystack_data['order_id']); ?>">
                        <input type="hidden" name="orderID" value="<?php echo e($paystack_data['order_id']); ?>">
                        <input type="hidden" name="amount" value="<?php echo e($paystack_data['price'] * 100); ?>"> 
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="currency" value="<?php echo e($paystack_data['currency']); ?>">

                        <input type="hidden" name="metadata" value="<?php echo e(json_encode($array = ['track' => $paystack_data['track'],'type' => $paystack_data['type']])); ?>" > 
                        <input type="hidden" name="reference" value="<?php echo e(Paystack::genTranxRef()); ?>"> 
                        <p>
                            <button class="btn btn-success btn-lg btn-block paystack-btn margin-top-30" type="submit" value="Pay Now!">
                                <?php echo e('Pay '.$paystack_data['price'].get_charge_currency('paystack'). __(' Now!')); ?>

                            </button>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function (){
            $(document).on('click','.paystack-btn',function (e){
                var submitBtn = $(this);
                submitBtn.text('Please Wait...');
                $('.notice').css('display','block');
            });

        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/@core/resources/views/frontend/payment/paystack.blade.php ENDPATH**/ ?>