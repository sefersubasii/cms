<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Tamma+2:wght@400;600;700&display=swap" rel="stylesheet">
    
    <title><?php echo e(__('Gig Invoice')); ?></title>
    <style>

        body * {
            font-family: 'Baloo Tamma 2', cursive;
        }

        table, td, th {
            border: 1px solid #ddd;
            text-align: left;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 15px;
        }

        /* cart page */
        .cart-wrapper table .thumbnail {
            max-width: 50px;
        }

        .cart-wrapper table .product-title {
            font-size: 16px;
            line-height: 26px;
            font-weight: 600;
            transition: 300ms all;
        }

        .cart-wrapper table .quantity {
            max-width: 80px;
            border: 1px solid #e2e2e2;
            height: 40px;
            padding-left: 10px;
        }

        .cart-wrapper table {
            color: #656565;
        }

        .cart-wrapper table th {
            color: #333;
        }

        .cart-total-wrap .title {
            font-size: 30px;
            line-height: 40px;
            font-weight: 700;
            margin-bottom: 30px;
        }

        .cart-total-table table td {
            color: #333;
        }

        .billing-details-wrapper .login-form {
            max-width: 450px;
        }

        .billing-details-wrapper {
            margin-bottom: 80px;
        }

        .billing-details-fields-wrapper .title {
            font-size: 30px;
            line-height: 40px;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .product-orders-summery-warp .title {
            font-size: 24px;
            text-align: left;
            margin-bottom: 7px;
        }

        #pdf_content_wrapper {
            max-width: 1000px;
        }

        .cart-wrapper table .thumbnail img {
            width: 80px;
        }

        .cart-total-table-wrap .title {
            font-size: 25px;
            line-height: 34px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .billing-and-shipping-details div:first-child {
            margin-bottom: 30px;
        }

        .billing-and-shipping-details div ul {
            margin: 0;
            padding: 0;
        }

        .billing-and-shipping-details div ul li {
            font-size: 16px;
            line-height: 30px;
        }

        .billing-and-shipping-details div .title {
            font-size: 22px;
            line-height: 26px;
            font-weight: 600;
        }

        .billing-and-shipping-details {
            margin-top: 40px;
        }

        .billing-wrap ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
    </style>
</head>
<body>
<div id="pdf_content_wrapper">
    <div class="logo-wrapper">
        <?php echo render_image_markup_by_attachment_id(get_static_option('site_logo')); ?>

    </div>
    <h2 class="main_title"><?php echo e(__('Gig Order Information')); ?></h2>
    <div class="gig-order-info">
        <ul>
            <li><strong><?php echo e(__('Order ID:')); ?></strong> #<?php echo e($gig_details->id); ?></li>
            <li><strong><?php echo e(__('Gig Name:')); ?></strong> <?php echo e(get_gig_name($gig_details->gig_id)); ?></li>
            <li><strong><?php echo e(__('Package Name:')); ?></strong> <?php echo e($gig_details->selected_plan_title); ?></li>
            <li><strong><?php echo e(__('Package Price:')); ?></strong> <?php echo e(amount_with_currency_symbol($gig_details->selected_plan_price,true)); ?></li>
            <li><strong><?php echo e(__('Revisions:')); ?></strong> <span class="alert-success"><?php echo e($gig_details->selected_plan_revisions.' '.__('Time Revisions')); ?></span></li>
            <li><strong><?php echo e(__('Payment Gateway:')); ?></strong> <?php echo e(str_replace('_',' ',$gig_details->selected_payment_gateway)); ?></li>
            <li><strong><?php echo e(__('Payment Status:')); ?></strong> <span class="<?php if($gig_details->payment_status == 'complete'): ?> alert-success <?php else: ?> alert-warning <?php endif; ?>"><?php echo e(ucwords($gig_details->payment_status)); ?></span></li>
            <li><strong><?php echo e(__('Transaction ID:')); ?></strong> <?php echo e($gig_details->transaction_id); ?></li>
            <li><strong><?php echo e(__('Order Status:')); ?></strong> <span class="<?php if($gig_details->order_status == 'complete'): ?> alert-success <?php else: ?> alert-info <?php endif; ?>"><?php echo e(ucwords(str_replace('_',' ',$gig_details->order_status))); ?> </span></li>
            <li><strong><?php echo e(__('Delivery Date:')); ?></strong> <span class="alert-danger"><?php echo e(get_future_date($gig_details->created_at,$gig_details->selected_plan_delivery_days)); ?></span></li>
        </ul>
    </div>
</div>
</body>
</html>
<?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/@core/resources/views/invoice/gig-invoice.blade.php ENDPATH**/ ?>