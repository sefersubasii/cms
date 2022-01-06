<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Navbar Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
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
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__('Navbar Button Settings')); ?></h4>
                        <form action="<?php echo e(route('admin.navbar.settings')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="navbar_button"><?php echo e(__('Button Show/Hide')); ?></label>
                                <label class="switch">
                                    <input type="checkbox" name="navbar_button"  <?php if(!empty(get_static_option('navbar_button'))): ?> checked <?php endif; ?> id="navbar_button">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <?php $__currentLoopData = get_all_language(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a class="nav-item nav-link <?php if($key == 0): ?> active <?php endif; ?>"  data-toggle="tab" href="#nav_<?php echo e($key); ?>" role="tab" aria-selected="true"><?php echo e($value->name); ?></a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </nav>
                            <div class="tab-content margin-top-20" id="nav-tabContent">
                                <?php $__currentLoopData = get_all_language(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="tab-pane fade <?php if($key == 0): ?> show active <?php endif; ?>" id="nav_<?php echo e($key); ?>" role="tabpanel" >
                                    <div class="form-group">
                                        <label for="navbar_<?php echo e($value->slug); ?>_button_text"><?php echo e(__('Button Text')); ?></label>
                                        <input type="text" name="navbar_<?php echo e($value->slug); ?>_button_text" class="form-control" value="<?php echo e(get_static_option('navbar_'.$value->slug.'_button_text')); ?>" id="navbar_<?php echo e($value->slug); ?>_button_text">
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="form-group">
                                <label for="navbar_button_custom_url_status"><?php echo e(__('Button Custom URL')); ?></label>
                                <label class="switch">
                                    <input type="checkbox" name="navbar_button_custom_url_status"  <?php if(!empty(get_static_option('navbar_button_custom_url_status'))): ?> checked <?php endif; ?> id="navbar_button_custom_url_status">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="navbar_button_custom_url"><?php echo e(__('Quote Button URL')); ?></label>
                                <input type="text" name="navbar_button_custom_url" class="form-control" value="<?php echo e(get_static_option('navbar_button_custom_url')); ?>" id="navbar_button_custom_url">
                            </div>
                            <h4 class="header-title margin-top-40"><?php echo e(__('Navbar Style Settings For Inner Pages')); ?></h4>
                            <input type="hidden" name="site_header_type" id="header_type" value="<?php echo e(get_static_option('site_header_type')); ?>">
                            <div class="img-select">
                                <div class="img-wrap">
                                    <img src="<?php echo e(asset('assets/frontend/navbar-variant/navbar-01.png')); ?>" style="width: 100%" data-header_type="navbar" alt="">
                                </div>
                            </div>
                            <div class="img-select">
                                <div class="img-wrap">
                                    <img src="<?php echo e(asset('assets/frontend/navbar-variant/navbar-02.png')); ?>" style="width: 100%" data-header_type="navbar-01" alt="">
                                </div>
                            </div>
                            <div class="img-select">
                                <div class="img-wrap">
                                    <img src="<?php echo e(asset('assets/frontend/navbar-variant/navbar-03.png')); ?>" style="width: 100%" data-header_type="navbar-02" alt="">
                                </div>
                            </div>
                            <div class="img-select">
                                <div class="img-wrap">
                                    <img src="<?php echo e(asset('assets/frontend/navbar-variant/navbar-04.png')); ?>" style="width: 100%" data-header_type="navbar-03" alt="">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Settings')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        (function($){
            "use strict";

            $(document).ready(function () {

                var imgSelect = $('.img-select');
                var id = $('#header_type').val();
                imgSelect.removeClass('selected');
                $('img[data-header_type="'+id+'"]').parent().parent().addClass('selected');

                $(document).on('click','.img-select img',function (e) {
                    e.preventDefault();
                    imgSelect.removeClass('selected');
                    $(this).parent().parent().addClass('selected').siblings();
                    $('#header_type').val($(this).data('header_type'));
                });



            })

        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/@core/resources/views/backend/pages/navbar-settings.blade.php ENDPATH**/ ?>