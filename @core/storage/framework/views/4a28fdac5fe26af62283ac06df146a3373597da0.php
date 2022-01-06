<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/nice-select.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('All Admin Role')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <?php echo $__env->make('backend/partials/message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__('All Admin Role')); ?></h4>
                        <div class="data-tables datatable-primary">
                            <table id="all_user_table" class="table table-default">
                                <thead class="text-capitalize">
                                <tr>
                                    <th><?php echo e(__('ID')); ?></th>
                                    <th><?php echo e(__('Role')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $all_role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($data->id); ?></td>
                                            <td><?php echo e($data->name); ?></td>
                                            <td>
                                                <a tabindex="0" class="btn btn-danger btn-sm" role="button" data-toggle="popover" data-trigger="focus" data-html="true" title="" data-content="
                                               <h6><?php echo e(__('Are you sure to delete this role?')); ?></h6>
                                               <form method='post' action='<?php echo e(route('admin.user.role.delete',$data->id)); ?>'>
                                               <input type='hidden' name='_token' value='<?php echo e(csrf_token()); ?>'>
                                               <br>
                                                <input type='submit' class='btn btn-danger btn-sm' value='<?php echo e(__('Yes,Please')); ?>'>
                                                </form>
                                                " data-original-title="">
                                                    <i class="ti-trash"></i>
                                                </a>
                                                <a data-toggle="modal" data-target="#user_edit_modal" data-id="<?php echo e($data->id); ?>" data-name="<?php echo e($data->name); ?>" class="btn btn-primary btn-sm edit_role_modal_btn">
                                                    <i class="ti-pencil"></i>
                                                </a>
                                                <a href="<?php echo e(route('admin.user.role.edit',$data->id)); ?>" class="btn btn-info btn-sm">
                                                     <?php echo e(__('Add/Edit Permission')); ?>

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
            <div class="col-lg-6  mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__('Add New Admin Role')); ?></h4>
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <form action="<?php echo e(route('admin.all.user.role')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="name"><?php echo e(__('Role Name')); ?></label>
                                <input type="text" class="form-control"  id="name" name="name" placeholder="<?php echo e(__('Enter Role name')); ?>">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Add New Role')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="user_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(__('Admin Role Edit')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="<?php echo e(route('admin.user.role.update')); ?>" id="user_edit_modal_form" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="edit_name"><?php echo e(__('Role Name')); ?></label>
                            <input type="text" class="form-control" name="name" >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Save changes')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        (function ($){
            "use strict";

           $(document).ready(function (){

               $(document).on('click','.edit_role_modal_btn',function (e){
                   e.preventDefault();

                   var allData = $(this).data();
                   var modalForm = $('#user_edit_modal_form');
                   modalForm.find('input[name="id"]').val(allData.id);
                   modalForm.find('input[name="name"]').val(allData.name);
               });

           });

        })(jQuery)
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/beta/@core/resources/views/backend/user-role-manage/admin-role.blade.php ENDPATH**/ ?>