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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('All Applicant')); ?>

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
                                    <h4 class="header-title"><?php echo e(__('All Applicant')); ?></h4>
                                    <div class="bulk-delete-wrapper">
                                        <div class="select-box-wrap">
                                            <select name="bulk_option" id="bulk_option">
                                                <option value=""><?php echo e(__('Bulk Action')); ?></option>
                                                <option value="delete"><?php echo e(__('Delete')); ?></option>
                                            </select>
                                            <button class="btn btn-primary btn-sm" id="bulk_delete_btn"><?php echo e(__('Apply')); ?></button>
                                        </div>
                                    </div>
                                    <div class="data-tables datatable-primary table-responsive">
                                        <table id="all_user_table" >
                                            <thead class="text-capitalize">
                                            <tr>
                                                <th class="no-sort">
                                                    <div class="mark-all-checkbox">
                                                        <input type="checkbox" class="all-checkbox">
                                                    </div>
                                                </th>
                                                <th><?php echo e(__('ID')); ?></th>
                                                <th><?php echo e(__('Job Title')); ?></th>
                                                <th><?php echo e(__('Job Position')); ?></th>
                                                <th><?php echo e(__('Date')); ?></th>
                                                <th><?php echo e(__('Action')); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $all_applicant; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <div class="bulk-checkbox-wrapper">
                                                            <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="<?php echo e($data->id); ?>">
                                                        </div>
                                                    </td>
                                                    <td><?php echo e($data->id); ?></td>
                                                    <td><?php echo e(!empty($data->job) ? $data->job->title : __('This job is not available or delete')); ?></td>
                                                    <td><?php echo e(!empty($data->job) ? $data->job->position : __('This job is not available or delete')); ?></td>
                                                        <?php
                                                            $all_custom_fields = [];
                                                            $all_custom_fields_un = unserialize($data->form_content);
                                                            unset($all_custom_fields_un['captcha_token']);
                                                            $all_custom_fields = json_encode($all_custom_fields_un);
                                                        ?>
                                                    <td><?php echo e(date_format($data->created_at,'d M Y')); ?></td>
                                                    <td>
                                                        <a tabindex="0" class="btn btn-lg btn-danger btn-sm mb-3 mr-1" role="button" data-toggle="popover" data-trigger="focus" data-html="true" title="" data-content="
                                                       <h6><?php echo e(__('Are you sure to delete this job application?')); ?></h6>
                                                       <form method='post' action='<?php echo e(route('admin.jobs.applicant.delete',$data->id)); ?>'>
                                                       <input type='hidden' name='_token' value='<?php echo e(csrf_token()); ?>'>
                                                       <br>
                                                        <input type='submit' class='btn btn-danger btn-sm' value='<?php echo e(__('Yes,Please')); ?>'>
                                                        </form>
                                                        " data-original-title="">
                                                            <i class="ti-trash"></i>
                                                        </a>
                                                        <a href="#"
                                                           data-toggle="modal"
                                                           data-target="#view_order_details_modal"
                                                           data-date="<?php echo e(date_format($data->created_at,'d M Y')); ?>"
                                                           data-attachment="<?php echo e(json_encode(unserialize($data->attachment))); ?>"
                                                           data-customfield="<?php echo e($all_custom_fields); ?>"
                                                           class="btn btn-lg btn-primary btn-sm mb-3 mr-1 view_order_details_btn"
                                                        >
                                                            <i class="ti-eye"></i>
                                                        </a>
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

    <div class="modal fade" id="view_order_details_modal" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="view-order-details-info">
                   <h4 class="title"><?php echo e(__('View Applicant Information')); ?></h4>
                   <div class="view-order-top-wrap">
                       <div class="data-wrap">
                           <?php echo e(__('Apply Date')); ?>: <span class="order-date-span"></span>
                       </div>
                   </div>
                   <div class="table-responsive">
                       <table class="order-all-custom-fields table-striped table-bordered"></table>
                   </div>
               </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <!-- Start datatable js -->
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {

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
                        'url' : "<?php echo e(route('admin.jobs.applicant.bulk.delete')); ?>",
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

            $(document).on('click','.view_order_details_btn',function (e) {
                e.preventDefault();
                var el = $(this);
                var allData = el.data();
                var parent = $('#view_order_details_modal');

                parent.find('.order-date-span').text(allData.date);
                parent.find('.order-all-custom-fields').html('');
                $.each(allData.customfield,function (index,value) {
                    parent.find('.order-all-custom-fields').append('<tr><td class="fname">'+index.replace('-',' ')+'</td> <td class="fvalue">'+value+'</td></tr>');
                });

                if(allData.attachment){
                    $.each(allData.attachment,function (index,value) {
                        parent.find('.order-all-custom-fields tbody').append('<tr class="attachment_list"><td class="fname">'+index.replace('-',' ')+'</td><td class="fvalue"><a href="<?php echo e(url('/')); ?>'+'/'+value+'" download>'+value.substr(26)+'</a></td></tr>');
                    });
                }
            })

            $('#all_user_table').DataTable( {
                "order": [[ 1, "desc" ]],
                "columnDefs": [ {
                    "targets": 'no-sort',
                    "orderable": false,
                } ]
            } );

        } );
    </script>
    <script src="<?php echo e(asset('assets/backend/js/dropzone.js')); ?>"></script>
    <?php echo $__env->make('backend.partials.media-upload.media-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/beta/@core/resources/views/backend/jobs/all-applicant.blade.php ENDPATH**/ ?>