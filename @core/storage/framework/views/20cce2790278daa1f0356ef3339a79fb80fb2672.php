<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <title><?php echo e(get_static_option('site_'.get_default_language().'_title')); ?> <?php echo e(__('Mail')); ?></title>

    <style>
        *{
            font-family: 'Open Sans', sans-serif;
        }
        .mail-container {
            max-width: 650px;
            margin: 0 auto;
            text-align: center;
        }

        .mail-container .logo-wrapper {
            background-color: <?php echo e(get_static_option('site_main_color_two')); ?>;
            padding: 20px 0 20px;
        }
        table {
            margin: 0 auto;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table td, table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        table tr:nth-child(even){background-color: #f2f2f2;}

        table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #f2f2f2;
            color: #333;
            text-transform: capitalize;
        }
        footer {
            margin: 20px 0;
            font-size: 14px;
        }
        .product-thumbnail img {
            max-width: 150px;
        }
        .product-title {
            text-align: left;
            font-weight: 500;
        }
        .billing-wrap,
        .shipping-wrap{
            text-align: left;
        }
        .subtitle {
            font-size: 20px;
            line-height: 30px;
            font-weight: 600;
        }
        .billing-wrap ul,
        .shipping-wrap ul{
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .billing-wrap ul li,
        .shipping-wrap ul li{
            margin: 5px 0;
        }
        .billing-wrap ul li strong,
        .shipping-wrap ul li strong{
            min-width: 100px;
            display: inline-block;
            position: relative;
        }

        .billing-wrap ul li strong:after ,
        .shipping-wrap ul li strong:after {
            position: absolute;
            right: 0;
            top: 0;
            content: ":";
        }
        .order-summery{
            margin-top: 40px;
            background-color: #f6f8ff;
            padding: 30px;
            text-align: left;
        }
        .order-summery table{
            text-align: left;
        }
        .extra-data {
            text-align: left;
            margin-bottom: 40px;
        }

        .extra-data ul {
            padding: 0;
            list-style: none;
            margin: 20px 0;
        }

        .extra-data ul li {
            margin-top: 14px;
        }
        .description h4 {
            font-size: 24px;
            margin-bottom: 35px;
            line-height: 34px;
        }

        .brief-wrapper p {
            margin: 0;
            margin-bottom: 10px;
            font-size: 16px;
            font-weight: 500;
            line-height: 26px;
        }

        .brief-wrapper {
            background-color: #f6f8ff;
            padding: 30px;
            text-align: left;
            margin-bottom: 40px;
        }
        .customer-data .subtitle {
            margin-top: 0;
        }
        .customer-data {
            display: flex;
            justify-content: space-between;
            background-color: #f6f8ff;
            padding: 30px;
            margin-bottom: 50px;
        }
        .product-info-wrap {
            text-align: left;
            padding: 20px;
            padding-top: 0;
        }

        .product-info-wrap h4 {
            font-size: 18px;
            line-height: 20px;
            margin-bottom: 20px;
        }

        .product-info-wrap .pdetails {
            font-size: 14px;
            display: block;
            line-height: 20px;
            margin-bottom: 2px;
        }
        .product-info-wrap h4 a {
            color: #333;
        }
        .order-summery h2 {
            margin: 0;
        }
        .gigs-info-wrap {
            display: flex;
            justify-content: space-between;
        }

        .gigs-info-wrap > div {
            width: calc(100% / 2 - 10px);
        }
        .billing-info-wrap {
            text-align: left;
            background-color: #f6f8ff;
            padding: 40px 20px;
            margin-right: 10px;
        }

        .billing-info-wrap ul li+li {
            margin-top: 20px;
        }

        .billing-info-wrap ul {
            margin: 0;
            padding: 0;
            padding-left: 20px;
        }
        .gig-price-plan {
            background-color: #f6f8ff;
            padding: 30px;
            text-align: left;
        }

        .gig-price-plan .title {
            font-size: 16px;
            line-height: 26px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .gig-price-plan .price-wrap {
            font-size: 30px;
            line-height: 40px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .gig-price-plan {}

        .gig-price-plan .feature-list {
            margin: 0;
            padding: 0;
            list-style: none;
            margin-bottom: 20px;
        }

        .gig-price-plan .feature-list li:before {
            position: absolute;
            width: 5px;
            height: 5px;
            background-color: green;
            content: '';
            border-radius: 50%;
            left: 0;
            top: 10px;
        }

        .gig-price-plan .feature-list li {
            position: relative;
            padding-left: 15px;
        }

        .gig-price-plan .revision-wrapper span {
            display: inline-block;
            font-size: 14px;
            line-height: 24px;
            margin-bottom: 10px;
            background-color: #ddd;
            padding: 2px 10px;
            border-radius: 2px;
        }

        .gig-price-plan .revision-wrapper span.delivery-time {
            background-color: #ffcbcb;
        }

        .gig-price-plan .revision-wrapper span.revisions {
            background-color: #cee6ce;
        }
        .gig-price-plan h2 {
            border-bottom: 1px solid #e2e2e2;
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="mail-container">
        <div class="logo-wrapper">
            <a href="<?php echo e(url('/')); ?>">
                <?php echo render_image_markup_by_attachment_id(get_static_option('site_white_logo')); ?>

            </a>
        </div>
        <?php if($type == 'customer'): ?>
        <div class="description">
            <h4><?php echo e(__('Your Order #'.$data->id.' has been Placed')); ?></h4>
        </div>
        <div class="brief-wrapper">
           <p> <?php echo e(__('Hello,')); ?> <?php echo e($data->full_name); ?></p>
            <p><?php echo e(__('Your order #'.$data->id)); ?> <?php echo e(__('has been placed on '.date_format($data->created_at,'d F Y H:m:s'))); ?> <?php echo e(__('via '.ucwords(str_replace('_',' ',$data->selected_payment_gateway)).'. Check your dashboard for more info.')); ?></p>
        </div>
        <?php else: ?>
        <div class="description">
            <h4><?php echo e(__('Your have a new order')); ?></h4>
        </div>
        <div class="brief-wrapper">
            <p> <?php echo e(__('Hey')); ?> </p>
            <p><?php echo e(__('Your have an gig order #'.$data->id)); ?> <?php echo e(' '.$data->billing_name); ?><?php echo e(__(' has been placed it on '.date_format($data->created_at,'d F Y H:m:s'))); ?> <?php echo e(__('via '.ucwords(str_replace('_',' ',$data->selected_payment_gateway)).'. Check your dashboard for more info.')); ?></p>
        </div>
        <?php endif; ?>
        <div class="gigs-info-wrap">
            <div class="billing-info-wrap">
                <ul>
                    <li><strong><?php echo e(__('Gig Name:')); ?></strong> <?php echo e(get_gig_name($data->gig_id)); ?></li>
                    <li><strong><?php echo e(__('Order Date:')); ?></strong> <?php echo e(date_format($data->created_at,'d M Y')); ?></li>
                    <li><strong><?php echo e(__('Order Delivery Date:')); ?></strong> <?php echo e(get_future_date($data->created_at,$data->selected_plan_delivery_days)); ?></li>
                    <li><strong><?php echo e(__('Total Revisions:')); ?></strong> <?php echo e($data->selected_plan_revisions); ?> <?php echo e(__('Time Revisions')); ?></li>
                </ul>
            </div>
            <div class="gig-price-plan order-page">
                <h2><?php echo e(__('Ordered Plan')); ?></h2>
                <h4 class="title"><?php echo e($data->selected_plan_title); ?></h4>
                <div class="price-wrap">
                    <?php echo e(amount_with_currency_symbol($data->selected_plan_price)); ?>

                </div>
                <?php
                $gig_details = \App\Gig::find($data->gig_id);
                $all_plan_features = !empty($gig_details->features) ? unserialize($gig_details->features) : [];
                $all_plan_description = !empty($gig_details->plan_description) ? unserialize($gig_details->plan_description) : [];
                $selected_plan_features = explode("\n",$all_plan_features[$data->selected_plan_index]);
                ?>

                <div class="description">
                    <p><?php echo e($all_plan_description[$data->selected_plan_index]); ?></p>
                </div>

                <ul class="feature-list">
                    <?php $__currentLoopData = $selected_plan_features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($item); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>

                <div class="revision-wrapper">
                    <span class="delivery-time"><i class="far fa-clock"></i> <?php echo e($data->selected_plan_delivery_days); ?> <?php echo e(__('Days Delivery')); ?></span>
                    <span class="revisions"><i class="fas fa-sync"></i> <?php echo e($data->selected_plan_revisions); ?> <?php echo e(__('Time Revisions')); ?></span>
                </div>
            </div>
        </div>
        <footer>
            <p> &copy; <?php echo e(__('All Right Reserved By')); ?> <?php echo e(get_static_option('site_'.get_default_language().'_title')); ?></p>
        </footer>
    </div>
</body>
</html>
<?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/beta/@core/resources/views/mail/gig-order.blade.php ENDPATH**/ ?>