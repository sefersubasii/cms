<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Add New User')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <!-- basic form start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__('New User')); ?></h4>
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
                        <form action="<?php echo e(route('admin.new.user')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="name"><?php echo e(__('Name')); ?></label>
                                <input type="text" class="form-control"  id="name" name="name" placeholder="<?php echo e(__('Enter name')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="username"><?php echo e(__('Username')); ?></label>
                                <input type="text" class="form-control"  id="username" name="username" placeholder="<?php echo e(__('Username')); ?>">
                                <small class="text text-danger"><?php echo e(__('Remember this username, user will login using this username')); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="email"><?php echo e(__('Email')); ?></label>
                                <input type="text" class="form-control"  id="email" name="email" placeholder="<?php echo e(__('Email')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="password"><?php echo e(__('Password')); ?></label>
                                <input type="password" class="form-control"  id="password" name="password" placeholder="<?php echo e(__('Password')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation"><?php echo e(__('Password Confirm')); ?></label>
                                <input type="password" class="form-control"  id="password_confirmation" name="password_confirmation" placeholder="<?php echo e(__('Password Confirmation')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="role"><?php echo e('Role'); ?></label>
                                <select name="role" id="role" class="form-control">
                                    <?php $__currentLoopData = $all_admin_role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image" id="image">
                                <label class="custom-file-label" for="image"><?php echo e(__('Image')); ?></label>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Add New User')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/beta/@core/resources/views/backend/user-role-manage/add-new-user.blade.php ENDPATH**/ ?>