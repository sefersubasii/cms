<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/bootstrap-tagsinput.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/dropzone.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/media-uploader.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('New Job Post')); ?>

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
                        <h4 class="header-title"><?php echo e(__('Add New Job Post')); ?></h4>
                        <form action="<?php echo e(route('admin.jobs.new')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-lg-12">
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
                                        <input type="text" class="form-control"  id="title" name="title" value="<?php echo e(old('title')); ?>" placeholder="<?php echo e(__('Title')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="slug"><?php echo e(__('Slug')); ?></label>
                                        <input type="text" class="form-control"  id="slug" name="slug" value="<?php echo e(old('slug')); ?>" placeholder="<?php echo e(__('Slug')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="position"><?php echo e(__('Job Position')); ?></label>
                                        <input type="text" class="form-control"  id="position" name="position" value="<?php echo e(old('position')); ?>" placeholder="<?php echo e(__('Position')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="company_name"><?php echo e(__('Company Name')); ?></label>
                                        <input type="text" class="form-control"  id="company_name" value="<?php echo e(old('company_name')); ?>"  name="company_name" placeholder="<?php echo e(__('Company Name')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="category"><?php echo e(__('Category')); ?></label>
                                        <select name="category_id" class="form-control" id="category">
                                            <option value=""><?php echo e(__("Select Category")); ?></option>
                                            <?php $__currentLoopData = $all_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="vacancy"><?php echo e(__('Vacancy')); ?></label>
                                        <input type="text" class="form-control"  id="vacancy" value="<?php echo e(old('vacancy')); ?>" name="vacancy" placeholder="<?php echo e(__('Vacancy')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="job_context"><?php echo e(__('Job Context')); ?></label>
                                        <textarea name="job_context" id="job_context" class="form-control" cols="30" placeholder="<?php echo e(__('Job Context')); ?>" rows="10"><?php echo e(old('job_context')); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="job_responsibility"><?php echo e(__('Job Responsibility')); ?></label>
                                        <textarea name="job_responsibility" id="job_responsibility" class="form-control" cols="30" placeholder="<?php echo e(__('Job Responsibility')); ?>" rows="10"><?php echo e(old('job_responsibility')); ?></textarea>
                                        <small class="info-text"><?php echo e(__('separate responsibility by pipe (|), to break in new line')); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="education_requirement"><?php echo e(__('Educational Requirements')); ?></label>
                                        <textarea name="education_requirement" id="education_requirement" class="form-control" cols="30" placeholder="<?php echo e(__('Educational Requirements')); ?>" rows="10"><?php echo e(old('education_requirement')); ?></textarea>
                                        <small class="info-text"><?php echo e(__('separate responsibility by pipe (|), to break in new line')); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="experience_requirement"><?php echo e(__('Experience Requirements')); ?></label>
                                        <textarea name="experience_requirement" id="experience_requirement" class="form-control" cols="30" placeholder="<?php echo e(__('Experience Requirements')); ?>" rows="10"><?php echo e(old('experience_requirement')); ?></textarea>
                                        <small class="info-text"><?php echo e(__('separate responsibility by pipe (|), to break in new line')); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="additional_requirement"><?php echo e(__('Additional Requirements')); ?></label>
                                        <textarea name="additional_requirement" id="additional_requirement" class="form-control" cols="30" placeholder="<?php echo e(__('Additional Requirements')); ?>" rows="10"><?php echo e(old('additional_requirement')); ?></textarea>
                                        <small class="info-text"><?php echo e(__('separate responsibility by pipe (|), to break in new line')); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="employment_status"><?php echo e(__('Employment Status')); ?></label>
                                        <select name="employment_status" id="employment_status"  class="form-control">
                                            <option value="full_time"><?php echo e(__('Full-Time')); ?></option>
                                            <option value="part_time"><?php echo e(__('Part-Time')); ?></option>
                                            <option value="project_based"><?php echo e(__('Project Based')); ?></option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="job_location"><?php echo e(__('Job Location')); ?></label>
                                        <input type="text" class="form-control"  id="job_location" name="job_location" value="<?php echo e(old('job_location')); ?>" placeholder="<?php echo e(__('Job Location')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="other_benefits"><?php echo e(__('Compensation & Other Benefits')); ?></label>
                                        <textarea name="other_benefits" id="other_benefits" class="form-control" cols="30" placeholder="<?php echo e(__('Compensation & Other Benefits')); ?>" rows="10"><?php echo e(old('other_benefits')); ?></textarea>
                                        <small class="info-text"><?php echo e(__('separate responsibility by pipe (|), to break in new line')); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="salary"><?php echo e(__('Salary')); ?></label>
                                        <input type="text" class="form-control"  id="salary" name="salary" value="<?php echo e(old('salary')); ?>" placeholder="<?php echo e(__('Salary')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="deadline"><?php echo e(__('Deadline')); ?></label>
                                        <input type="date" class="form-control"  id="deadline" name="deadline" placeholder="<?php echo e(__('Deadline')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="is_featured"><strong><?php echo e(__('Is Featured')); ?></strong></label>
                                        <label class="switch ">
                                            <input type="checkbox" name="is_featured" id="is_featured">
                                            <span class="slider onff"></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_tags"><?php echo e(__('Meta Tags')); ?></label>
                                        <input type="text" name="meta_tags"  class="form-control" data-role="tagsinput" id="meta_tags">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description"><?php echo e(__('Meta Description')); ?></label>
                                        <textarea name="meta_description"  class="form-control" rows="5" id="meta_description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="company_logo"><?php echo e(__('Company Logo')); ?></label>
                                        <div class="media-upload-btn-wrapper">
                                            <div class="img-wrap"></div>
                                            <input type="hidden" name="company_logo">
                                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal" data-target="#media_upload_modal">
                                                <?php echo e(__('Upload Image')); ?>

                                            </button>
                                        </div>
                                        <small><?php echo e(__('Recommended image size 80x80')); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="status"><?php echo e(__('Status')); ?></label>
                                        <select name="status" id="status"  class="form-control">
                                            <option value="publish"><?php echo e(__('Publish')); ?></option>
                                            <option value="draft"><?php echo e(__('Draft')); ?></option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Add New Job')); ?></button>
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
    <script src="<?php echo e(asset('assets/backend/js/bootstrap-tagsinput.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/dropzone.js')); ?>"></script>
    <?php echo $__env->make('backend.partials.media-upload.media-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $(document).ready(function () {

            $(document).on('change','#language',function(e){
                e.preventDefault();
                var selectedLang = $(this).val();
                $.ajax({
                    url: "<?php echo e(route('admin.jobs.category.by.lang')); ?>",
                    type: "POST",
                    data: {
                        _token : "<?php echo e(csrf_token()); ?>",
                        lang : selectedLang
                    },
                    success:function (data) {
                        $('#category').html('<option value="">Select Category</option>');
                        $.each(data,function(index,value){
                            $('#category').append('<option value="'+value.id+'">'+value.title+'</option>')
                        });
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/beta/@core/resources/views/backend/jobs/new-job.blade.php ENDPATH**/ ?>