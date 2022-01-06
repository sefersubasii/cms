<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e(__('Payment Success For ').get_static_option('site_'.get_default_language().'_title')); ?></title>
    <style>
        .mail-container {
            max-width: 650px;
            margin: 0 auto;
            text-align: center;
        }

        .mail-container .logo-wrapper {
            background-color: #111d5c;
            padding: 20px 0 20px;
        }
        table {
            margin: 0 auto;
        }
        table {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        table td, table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        table tr:nth-child(even){background-color: #f2f2f2;}

        table tr:hover {background-color: #ddd;}

        table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #111d5c;
            color: white;
        }
        footer {
            margin: 20px 0;
            font-size: 14px;
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
    <p><?php echo e(__('Hi '.$data->name)); ?></p>
    <p><?php echo e(__('You payment success for '. get_static_option('site_'.get_default_language().'_title'))); ?></p>
    <table>
        <tr>
            <td><?php echo e(__('Attendance ID')); ?></td>
            <td><?php echo e($data->attendance_id); ?></td>
        </tr>
        <tr>
            <td><?php echo e(__('Event Name')); ?></td>
            <td><?php echo e($data->event_name); ?></td>
        </tr>
        <tr>
            <td><?php echo e(__('Event Cost')); ?></td>
            <td><?php echo e(amount_with_currency_symbol($data->event_cost)); ?></td>
        </tr>
        <tr>
            <td><?php echo e(__('Quantity')); ?></td>
            <td><?php echo e($data->attendance_logs->quantity); ?></td>
        </tr>
        <tr>
            <td><?php echo e(__('Payment Gateway')); ?></td>
            <td><?php echo e(ucfirst(str_replace('_',' ',$data->package_gateway))); ?></td>
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
    <footer>
        &copy; All Right Reserved By <?php echo e(get_static_option('site_'.get_default_language().'_title')); ?>

    </footer>
</div>
</body>
</html>
<?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/beta/@core/resources/views/mail/event-payment-success.blade.php ENDPATH**/ ?>