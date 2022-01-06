<?php $default_lang = get_default_language(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e(__('Payment Success For ').get_static_option('site_'.$default_lang.'_title')); ?></title>
    <style>
        *{
            font-family: 'Open Sans', sans-serif;
        }
        body {
            background-color: #fdfdfd;
        }
        .mail-container {
            max-width: 650px;
            margin: 50px auto;
            text-align: center;
        }

        .mail-container .logo-wrapper {
            padding: 20px 0 20px;
            border-bottom: 5px solid <?php echo e(get_static_option('site_color')); ?>;
        }
        table {
            margin: 0 auto;
        }
        table {

            border-collapse: collapse;
            width: 100%;
        }

        table td, table th {
            border: 1px solid rgba(0,0,0,.05);
            padding: 10px 20px;
            background-color: #fafafa;
            text-align: left;
            font-size: 14px;
            text-transform: capitalize;
        }

        table tr:nth-child(even){background-color: #f2f2f2;}

        table tr:hover {background-color: #ddd;}

        table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: <?php echo e(get_static_option('site_color')); ?>;
            color: white;
        }
        footer {
            margin: 20px 0;
            font-size: 14px;
        }
        .main-content-wrap {
            background-color: #fff;
            box-shadow: 0 0 15px 0 rgba(0,0,0,.05);
            padding: 30px;
        }

        .main-content-wrap p {
            margin: 0;
            text-align: left;
            font-size: 14px;
            line-height: 26px;
        }

        .main-content-wrap p:first-child {
            margin-bottom: 10px;
        }

        .main-content-wrap .price-wrap {
            font-size: 60px;
            line-height: 70px;
            font-weight: 600;
            margin: 40px 0;
        }
        table {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="mail-container">
    <div class="logo-wrapper">
        <a href="<?php echo e(url('/')); ?>">
            <?php echo render_image_markup_by_attachment_id(get_static_option('site_logo')); ?>

        </a>
    </div>
    <div class="main-content-wrap">
        <p><?php echo e(__('Hello')); ?></p>
        <?php if($type == 'customer'): ?>
        <p><?php echo e(__('A payment from '.$data->name.' was successful. Donation Log ID #'.$data->donation_id.', Donated cause "'.$data->donation->title.'" Paid Via '.ucfirst(str_replace('_',' ',$data->payment_gateway)))); ?></p>
        <?php else: ?>
            <p><?php echo e(__('You get payment from '.$data->name.'. For donation log ID #'.$data->donation_id.', donated cause "'.$data->donation->title.'" paid via '.ucfirst(str_replace('_',' ',$data->payment_gateway)))); ?></p>
        <?php endif; ?>
        <div class="price-wrap"><?php echo e(amount_with_currency_symbol($data->amount)); ?></div>
        <table>
            <tr>
                <td><?php echo e(__('Donate ID')); ?></td>
                <td>#<?php echo e($data->donation_id); ?></td>
            </tr>
            <tr>
                <td><?php echo e(__('Cause Name')); ?></td>
                <td><?php echo e($data->donation->title); ?></td>
            </tr>
            <tr>
                <td><?php echo e(__('Donate Amount')); ?></td>
                <td><?php echo e(amount_with_currency_symbol($data->amount)); ?></td>
            </tr>
            <tr>
                <td><?php echo e(__('Payment Gateway')); ?></td>
                <td><?php echo e(ucfirst(str_replace('_',' ',$data->payment_gateway))); ?></td>
            </tr>
            <tr>
                <td><?php echo e(__('Payment Status')); ?></td>
                <td><?php echo e($data->status); ?></td>
            </tr>
            <tr>
                <td><?php echo e(__('Transaction ID')); ?></td>
                <td><?php echo e($data->transaction_id); ?></td>
            </tr>
        </table>
    </div>
    <footer>
        &copy; All Right Reserved By <?php echo e(get_static_option('site_'.$default_lang.'_title')); ?>

    </footer>
</div>
</body>
</html>
<?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/beta/@core/resources/views/mail/donation-payment-success.blade.php ENDPATH**/ ?>