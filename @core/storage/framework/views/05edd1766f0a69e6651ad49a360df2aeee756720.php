<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/bootstrap-tagsinput.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/summernote-bs4.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/dropzone.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/media-uploader.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('New Gig')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <!-- basic form start -->
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
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__('Add New Gig')); ?></h4>
                        <form action="<?php echo e(route('admin.gigs.new')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="language"><strong><?php echo e(__('Language')); ?></strong></label>
                                        <select name="lang" id="language" class="form-control">
                                            <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($lang->slug); ?>"><?php echo e($lang->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title"><?php echo e(__('Title')); ?></label>
                                        <input type="text" class="form-control"  value="<?php echo e(old('title')); ?>" name="title" placeholder="<?php echo e(__('Title')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="slug"><?php echo e(__('Slug')); ?></label>
                                        <input type="text" class="form-control"  id="slug"  name="slug" placeholder="<?php echo e(__('Slug')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo e(__('Content')); ?></label>
                                        <input type="hidden" name="description" >
                                        <div class="summernote"></div>
                                    </div>
                                    <div class="form-group attributes-field" >
                                        <label for="attributes"><?php echo e(__('Price Plan')); ?></label>
                                        <div class="attribute-field-wrapper" data-type="price_plan">
                                            <span class="label-title"><?php echo e(__('Plan Title')); ?></span>
                                            <input type="text" class="form-control" name="plan_title[]" placeholder="<?php echo e(__('Plan Title')); ?>">
                                            <span class="label-title"><?php echo e(__('Plan Price')); ?></span>
                                            <input type="text" class="form-control" name="plan_price[]" placeholder="<?php echo e(__('Plan Price')); ?>">
                                            <span class="label-title"><?php echo e(__('Delivery Time')); ?></span>
                                            <input type="text" class="form-control" name="delivery_time[]" placeholder="<?php echo e(__('Delivery Time')); ?>">
                                            <span class="label-title"><?php echo e(__('Revisions')); ?></span>
                                            <input type="text" class="form-control" name="revisions[]" placeholder="<?php echo e(__('Revisions')); ?>">
                                            <span class="label-title"><?php echo e(__('Plan Description')); ?></span>
                                            <textarea name="plan_description[]" class="form-control" rows="5" placeholder="<?php echo e(__('Plan Description ')); ?>"></textarea>
                                            <span class="label-title"><?php echo e(__('Plan Features')); ?></span>
                                            <textarea name="features[]" class="form-control" rows="5" placeholder="<?php echo e(__('Plan Features ')); ?>"></textarea>
                                            <span class="info-text"><?php echo e(__('separate feature by new line')); ?></span>
                                            <div class="icon-wrapper">
                                                <span class="add_attributes"><i class="ti-plus"></i></span>
                                                <span class="remove_attributes"><i class="ti-minus"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group attributes-field">
                                        <label for="attributes"><?php echo e(__('Faqs')); ?></label>
                                        <div class="attribute-field-wrapper" data-type="faq">
                                            <span class="label-title"><?php echo e(__('Faq Title')); ?></span>
                                            <input type="text" class="form-control" name="faqs_title[]" placeholder="<?php echo e(__('Faq Title')); ?>">
                                            <span class="label-title"><?php echo e(__('Faq Description')); ?></span>
                                            <textarea name="faqs_description[]" class="form-control" rows="5" placeholder="<?php echo e(__('Faq Description')); ?>"></textarea>
                                            <div class="icon-wrapper">
                                                <span class="add_attributes"><i class="ti-plus"></i></span>
                                                <span class="remove_attributes"><i class="ti-minus"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="post-type-sidebar">
                                        <div class="form-group">
                                            <label for="category_id"><?php echo e(__('Category')); ?></label>
                                            <select name="category_id" class="form-control" id="category_id">
                                                <option value=""><?php echo e(__("Select Category")); ?></option>
                                                <?php $__currentLoopData = $gigs_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="image"><?php echo e(__('Gallery')); ?></label>
                                            <div class="media-upload-btn-wrapper gallery">
                                                <div class="img-wrap"></div>
                                                <input type="hidden" name="gallery">
                                                <button type="button" class="btn btn-info media_upload_form_btn" data-mulitple="true" data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal" data-target="#media_upload_modal">
                                                    <?php echo e(__('Upload Image')); ?>

                                                </button>
                                            </div>
                                            <small><?php echo e(__('Recommended image size 1920x1280')); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="image"><?php echo e(__('Image')); ?></label>
                                            <div class="media-upload-btn-wrapper">
                                                <div class="img-wrap"></div>
                                                <input type="hidden" name="image">
                                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal" data-target="#media_upload_modal">
                                                    <?php echo e(__('Upload Image')); ?>

                                                </button>
                                            </div>
                                            <small><?php echo e(__('Recommended image size 1920x1280')); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_tags"><?php echo e(__('Meta Tags')); ?></label>
                                            <input type="text" name="meta_tags"  class="form-control" value="<?php echo e(old('meta_tags')); ?>" data-role="tagsinput" id="meta_tags">
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_description"><?php echo e(__('Meta Description')); ?></label>
                                            <textarea name="meta_description"  class="form-control" rows="5" id="meta_description"><?php echo e(old('meta_description')); ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="status"><?php echo e(__('Status')); ?></label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="publish"><?php echo e(__('Publish')); ?></option>
                                                <option value="draft"><?php echo e(__('Draft')); ?></option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Publish')); ?></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('backend.partials.media-upload.media-upload-markup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/backend/js/summernote-bs4.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/bootstrap-tagsinput.js')); ?>"></script>
    <script>
        $(document).ready(function () {


            $('.summernote').summernote({
                height: 400,   //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                },
                callbacks: {
                    onChange: function(contents, $editable) {
                        $(this).prev('input').val(contents);
                    }
                }
            });
            if($('.summernote').length > 1){
                $('.summernote').each(function(index,value){
                    $(this).summernote('code', $(this).data('content'));
                });
            }

            $(document).on('change','#language',function(e){
                e.preventDefault();
                var selectedLang = $(this).val();
                $.ajax({
                    url: "<?php echo e(route('admin.gigs.category.lang.cat')); ?>",
                    type: "POST",
                    data: {
                        _token : "<?php echo e(csrf_token()); ?>",
                        lang : selectedLang
                    },
                    success:function (data) {
                        $('#category_id').html('<option value="">Select Category</option>');
                        $.each(data,function(index,value){
                            $('#category_id').append('<option value="'+value.id+'">'+value.name+'</option>')
                        });
                    }
                });
            });

            $('.icp-dd').iconpicker();
            $('.icp-dd').on('iconpickerSelected', function (e) {
                var selectedIcon = e.iconpickerValue;
                $(this).parent().parent().children('input').val(selectedIcon);
            });

            $(document).on('change','select[name="icon_type"]',function (e){
                e.preventDefault();
                var iconType = $(this).val();
                iconTypeFieldVal(iconType);
            });
            defaultIconType();

            function defaultIconType(){
                var iconType = $('select[name="icon_type"]').val();
                iconTypeFieldVal(iconType);
            }

            function iconTypeFieldVal(iconType){
                if (iconType == 'icon'){
                    $('input[name="img_icon"]').parent().parent().hide();
                    $('input[name="icon"]').parent().show();
                }else if(iconType == 'image'){
                    $('input[name="icon"]').parent().hide();
                    $('input[name="img_icon"]').parent().parent().show();
                }
            }

            $(document).on('click','.attribute-field-wrapper .add_attributes',function (e) {
                e.preventDefault();
                var el = $(this);
                var type = el.parent().parent().data('type');
                if (type == 'faq'){
                $(this).parent().parent().parent().append(' <div class="attribute-field-wrapper" data-type="faq">\n' +
                    '<input type="text" class="form-control" name="faqs_title[]" placeholder="<?php echo e(__('Faq Title')); ?>">\n' +
                    '<textarea name="faqs_description[]" class="form-control" rows="5" placeholder="<?php echo e(__('Faq Description')); ?>"></textarea>\n' +
                    '<div class="icon-wrapper">\n' +
                    '<span class="add_attributes"><i class="ti-plus"></i></span>\n' +
                    '<span class="remove_attributes"><i class="ti-minus"></i></span>\n' +
                    '</div>\n' +
                    '</div>');
                }else{
                    $(this).parent().parent().parent().append('<div class="attribute-field-wrapper" data-type="price_plan">\n' +
                        '<input type="text" class="form-control" name="plan_title[]" placeholder="title">\n' +
                        '<input type="text" class="form-control" name="plan_price[]" placeholder="price">\n' +
                        '<input type="text" class="form-control" name="delivery_time[]" placeholder="delivery time">\n' +
                        '<input type="text" class="form-control" name="revisions[]" placeholder="revisions">\n' +
                        '<textarea name="plan_description[]" class="form-control" rows="5" placeholder="Plan Description"></textarea>\n' +
                        '<textarea name="features[]" class="form-control" rows="5" placeholder="features"></textarea>\n' +
                        '<span class="info-text">separate feature by new line</span>\n' +
                        '<div class="icon-wrapper">\n' +
                        '<span class="add_attributes"><i class="ti-plus"></i></span>\n' +
                        '<span class="remove_attributes"><i class="ti-minus"></i></span>\n' +
                        '</div>\n' +
                        '</div>');
                }

            });
            $(document).on('click','.attribute-field-wrapper .remove_attributes',function (e) {
                e.preventDefault();

                var el = $(this);
                var type = el.parent().parent().data('type');

                if($('.attribute-field-wrapper[data-type="'+type+'"]').find('.remove_attributes').length > 1){
                    $(this).parent().parent().remove();
                }
            });

        });
    </script>
    <script src="<?php echo e(asset('assets/backend/js/dropzone.js')); ?>"></script>
    <?php echo $__env->make('backend.partials.media-upload.media-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/beta/@core/resources/views/backend/gigs/new-gig.blade.php ENDPATH**/ ?>