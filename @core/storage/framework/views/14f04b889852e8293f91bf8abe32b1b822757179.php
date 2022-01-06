<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button{
            padding: 0 !important;
        }
        div.dataTables_wrapper div.dataTables_length select {
            width: 60px;
            display: inline-block;
        }
    </style>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/dropzone.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/media-uploader.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/summernote-bs4.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('All Gig Orders')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <?php echo $__env->make('backend/partials/message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php if($errors->any()): ?>
                                        <div class="alert alert-danger">
                                            <ul>
                                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li><?php echo e($error); ?></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                    <h4 class="header-title"><?php echo e(__('All Gig Orders')); ?></h4>
                                    <div class="bulk-delete-wrapper">
                                        <div class="select-box-wrap">
                                            <select name="bulk_option" id="bulk_option">
                                                <option value=""><?php echo e(__('Bulk Action')); ?></option>
                                                <option value="delete"><?php echo e(__('Delete')); ?></option>
                                            </select>
                                            <button class="btn btn-primary btn-sm" id="bulk_delete_btn"><?php echo e(__('Apply')); ?></button>
                                        </div>
                                        <div class="select-box-wrap">
                                            <form action="" method="get">
                                                <select name="payment_status">
                                                    <option value=""><?php echo e(__('Payment Status')); ?></option>
                                                    <option <?php if($payment_status == 'complete'): ?> selected <?php endif; ?> value="complete"><?php echo e(__('Payment Complete')); ?></option>
                                                    <option <?php if($payment_status == 'pending'): ?> selected <?php endif; ?> value="pending"><?php echo e(__('Payment Pending')); ?></option>
                                                </select>
                                                <select name="order_status" >
                                                    <option value=""><?php echo e(__('Order Status Status')); ?></option>
                                                    <option <?php if($order_status == 'in_progress'): ?> selected <?php endif; ?> value="in_progress"><?php echo e(__('Order In Progress')); ?></option>
                                                    <option <?php if($order_status == 'complete'): ?> selected <?php endif; ?> value="complete"><?php echo e(__('Order Complete')); ?></option>
                                                    <option <?php if($order_status == 'pending'): ?> selected <?php endif; ?> value="pending"><?php echo e(__('Order Pending')); ?></option>
                                                    <option <?php if($order_status == 'cancel'): ?> selected <?php endif; ?> value="cancel"><?php echo e(__('Order Cancel')); ?></option>
                                                </select>
                                                <button class="btn btn-primary btn-sm" type="submit"><?php echo e(__('Filter')); ?></button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="data-tables datatable-primary table-responsive">
                                        <table id="all_user_table" >
                                            <thead class="text-capitalize">
                                            <tr>
                                                <th>
                                                    <div class="mark-all-checkbox">
                                                        <input type="checkbox" class="all-checkbox">
                                                    </div>
                                                </th>
                                                <th><?php echo e(__('ID')); ?></th>
                                                <th><?php echo e(__('Gig Info')); ?></th>
                                                <th><?php echo e(__('Name')); ?></th>
                                                <th><?php echo e(__('Email')); ?></th>
                                                <th><?php echo e(__('Date')); ?></th>
                                                <th><?php echo e(__('Action')); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $all_gigs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <div class="bulk-checkbox-wrapper">
                                                            <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="<?php echo e($data->id); ?>">
                                                        </div>
                                                    </td>
                                                    <td><?php echo e($data->id); ?></td>
                                                    <td>
                                                        <div class="gig-order-info">
                                                            <ul>
                                                                <li><strong><?php echo e(__('Gig Name:')); ?></strong> <?php echo e(get_gig_name($data->gig_id)); ?></li>
                                                                <li><strong><?php echo e(__('Package Name:')); ?></strong> <?php echo e($data->selected_plan_title); ?></li>
                                                                <li><strong><?php echo e(__('Package Price:')); ?></strong> <?php echo e(amount_with_currency_symbol($data->selected_plan_price)); ?></li>
                                                                <li><strong><?php echo e(__('Revisions:')); ?></strong> <span class="alert-success"><?php echo e($data->selected_plan_revisions.' '.__('Time Revisions')); ?></span></li>
                                                                <li><strong><?php echo e(__('Payment Gateway:')); ?></strong> <?php echo e(str_replace('_',' ',$data->selected_payment_gateway)); ?></li>
                                                                <li><strong><?php echo e(__('Payment Status:')); ?></strong> <span class="<?php if($data->payment_status == 'complete'): ?> alert-success <?php else: ?> alert-warning <?php endif; ?>"><?php echo e(ucwords($data->payment_status)); ?></span></li>
                                                                <li><strong><?php echo e(__('Order Status:')); ?></strong> <span class="<?php if($data->order_status == 'complete'): ?> alert-success <?php else: ?> alert-info <?php endif; ?>"> <?php echo e(ucwords(str_replace('_',' ',$data->order_status))); ?> </span></li>
                                                                <li><strong><?php echo e(__('Delivery Date:')); ?></strong> <span class="alert-danger"><?php echo e(get_future_date($data->created_at,$data->selected_plan_delivery_days)); ?></span></li>
                                                                <?php if($data->selected_payment_gateway == 'manual_payment' && $data->payment_status == 'pending'): ?>
                                                                <li><strong><?php echo e(__('Transaction ID:')); ?></strong> <span class="alert-info"><?php echo e($data->transaction_id); ?></span></li>
                                                                <?php endif; ?>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td><?php echo e($data->full_name); ?></td>
                                                    <td><?php echo e($data->email); ?></td>
                                                    <td><?php echo e(date_format($data->created_at,'d M Y')); ?></td>
                                                    <td>
                                                        <a tabindex="0" class="btn btn-danger btn-xs mb-3 mr-1" role="button" data-toggle="popover" data-trigger="focus" data-html="true" title="" data-content="
                                                       <h6><?php echo e(__('Are you sure to delete this order?')); ?></h6>
                                                       <form method='post' action='<?php echo e(route('admin.gigs.orders.delete',$data->id)); ?>'>
                                                       <input type='hidden' name='_token' value='<?php echo e(csrf_token()); ?>'>
                                                       <br>
                                                        <input type='submit' class='btn btn-danger btn-sm' value='<?php echo e(__('Yes,Please')); ?>'>
                                                        </form>
                                                        " data-original-title="">
                                                            <i class="ti-trash"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-secondary btn-xs mb-3 mr-1 gig_order_send_mail_btn" data-toggle="modal" data-gigorderid="<?php echo e($data->id); ?>" data-name="<?php echo e($data->full_name); ?>" data-target="#send_mail_to_customer"><i class="ti-email"></i></a>
                                                        <a href="<?php echo e(route('admin.gigs.orders.message',$data->id)); ?>" class="btn btn-primary btn-xs mb-3 mr-1">
                                                            <i class="ti-eye"></i>
                                                        </a>
                                                        <a href="#" data-toggle="modal" data-target="#change_order_status" data-gigorderid="<?php echo e($data->id); ?>" data-status="<?php echo e($data->order_status); ?>"
                                                           class="btn btn-info btn-xs mb-3 mr-1 gig_order_status_change_btn" title="<?php echo e(__('change status')); ?>"><i class="ti-pencil"></i></a>
                                                        <?php if( $data->payment_status == 'pending'): ?>
                                                            <form action="<?php echo e(route('admin.gig.order.reminder.mail')); ?>" method="post" enctype="multipart/form-data">
                                                                <?php echo csrf_field(); ?>
                                                                <input type="hidden" name="order_id" value="<?php echo e($data->id); ?>">
                                                                <button class="btn btn-light btn-xs mb-3 mr-1" title="<?php echo e(__('send reminder mail')); ?>" type="submit"><i class="ti-bell"></i></button>
                                                            </form>
                                                        <?php endif; ?>
                                                        <?php if(!empty( $data->payment_status == 'complete')): ?>
                                                            <form action="<?php echo e(route('frontend.gig.invoice.generate')); ?>"  method="post">
                                                                <?php echo csrf_field(); ?>
                                                                <input type="hidden" name="id"  value="<?php echo e($data->id); ?>">
                                                                <button class="btn btn-info" type="submit"><?php echo e(__('Invoice')); ?></button>
                                                            </form>
                                                        <?php endif; ?>
                                                        <?php if($data->selected_payment_gateway == 'manual_payment' && $data->payment_status == 'pending'): ?>
                                                            <a tabindex="0" class="btn btn-success btn-xs mb-3 mr-1" role="button" data-toggle="popover" data-trigger="focus" data-html="true" title="" data-content="
                                                       <h6><?php echo e(__('Are you sure to approve this payment?')); ?></h6>
                                                       <form method='post' action='<?php echo e(route('admin.gig.payment.approve',$data->id)); ?>'>
                                                       <input type='hidden' name='_token' value='<?php echo e(csrf_token()); ?>'>
                                                       <br>
                                                        <input type='submit'class='btn btn-success btn-sm' value='<?php echo e(__('Yes,Approve')); ?>'>
                                                        </form>
                                                        " data-original-title="">
                                                                <i class="ti-check"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Primary table end -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="change_order_status" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(__('Change Order Status')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="<?php echo e(route('admin.gig.order.status.change')); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="order_id">
                        <div class="form-group">
                            <label for="order_status"><?php echo e(__('Order Status')); ?></label>
                            <select name="order_status" class="form-control">
                                <option value="pending"><?php echo e(__('Pending')); ?></option>
                                <option value="in_progress"><?php echo e(__('In Progress')); ?></option>
                                <option value="cancel"><?php echo e(__('Cancel')); ?></option>
                                <option value="complete"><?php echo e(__('Complete')); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-xs btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-xs btn-primary"><?php echo e(__('Save Changes')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="send_mail_to_customer" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(__('Send Mail')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="<?php echo e(route('admin.gig.order.mail')); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="order_id">
                        <div class="form-group">
                            <label for=""><?php echo e(__('Subject')); ?></label>
                            <input type="text" class="form-control" name="subject">
                        </div>
                       <div class="form-group">
                           <label for=""><?php echo e(__('Message')); ?></label>
                           <textarea name="message" cols="30" rows="10" style="display: none;"></textarea>
                           <div class="summernote"></div>
                       </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-xs btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-xs btn-primary"><?php echo e(__('Send Mail')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php echo $__env->make('backend.partials.media-upload.media-upload-markup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <!-- Start datatable js -->
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script src="<?php echo e(asset('assets/backend/js/summernote-bs4.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/dropzone.js')); ?>"></script>
    <?php echo $__env->make('backend.partials.media-upload.media-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $(document).ready(function($) {

            $(document).on('click','.gig_order_send_mail_btn',function (e){
               e.preventDefault();
                var el = $(this);
                var allData = el.data();
                var formContainer = $('#send_mail_to_customer form');

                formContainer.find('input[name="order_id"]').val(allData.gigorderid);
                $('.summernote').summernote({
                    height: 200,   //set editable area's height
                    codemirror: { // codemirror options
                        theme: 'monokai'
                    },
                    callbacks: {
                        onChange: function(contents, $editable) {
                            $(this).prev('textarea').val(contents);
                        }
                    }
                });
                if($('.summernote').length > 0){
                    $('.summernote').each(function(index,value){
                        $(this).summernote('code', 'Hello '+allData.name+',');
                    });
                }

            });


            $(document).on('click','.gig_order_status_change_btn',function (e){
               e.preventDefault();
                var el = $(this);
                var allData = el.data();
                var formContainer = $('#change_order_status form');

                formContainer.find('input[name="order_id"]').val(allData.gigorderid);
                formContainer.find('select[name="order_status"] option[value="'+allData.status+'"]').attr('selected',true);
            });

            $(document).on('click','#bulk_delete_btn',function (e) {
                e.preventDefault();
                var bulkOption = $('#bulk_option').val();
                var allCheckbox =  $('.bulk-checkbox:checked');
                var allIds = [];
                allCheckbox.each(function(index,value){
                    allIds.push($(this).val());
                });
                if(allIds != '' && bulkOption == 'delete'){
                    $(this).text('Deleting...');
                    $.ajax({
                        'type' : "POST",
                        'url' : "<?php echo e(route('admin.gig.order.bulk.action')); ?>",
                        'data' : {
                            _token: "<?php echo e(csrf_token()); ?>",
                            ids: allIds
                        },
                        success:function (data) {
                            location.reload();
                        }
                    });
                }

            });

            $('.all-checkbox').on('change',function (e) {
                e.preventDefault();
                var value = $('.all-checkbox').is(':checked');
                var allChek = $(this).parent().parent().parent().parent().parent().find('.bulk-checkbox');
                //have write code here fr
                if( value == true){
                    allChek.prop('checked',true);
                }else{
                    allChek.prop('checked',false);
                }
            });

            $('#all_user_table').DataTable( {
                "order": [[ 1, "desc" ]],
                "columnDefs": [ {
                    "targets": 'no-sort',
                    "orderable": false,
                } ]
            } );

        } );
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/beta/@core/resources/views/backend/gigs/gig-order-manage.blade.php ENDPATH**/ ?>