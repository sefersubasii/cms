<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/bootstrap-tagsinput.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/dropzone.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/media-uploader.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Edit Job Post')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <!-- basic form start -->
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <?php echo $__env->make('backend/partials/message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.error-msg','data' => []]); ?>
<?php $component->withName('error-msg'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap">
                            <h4 class="header-title"><?php echo e(__('Edit Job Post')); ?></h4>
                            <a href="<?php echo e(route('admin.jobs.all')); ?>" class="btn btn-xs btn-primary"><?php echo e(__('All Job Posts')); ?></a>
                        </div>
                        <form action="<?php echo e(route('admin.jobs.update')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="job_id" value="<?php echo e($job_post->id); ?>">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="language"><strong><?php echo e(__('Language')); ?></strong></label>
                                        <select name="lang" id="language" class="form-control">
                                            <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if($job_post->lang == $lang->slug): ?> selected <?php endif; ?> value="<?php echo e($lang->slug); ?>"><?php echo e($lang->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title"><?php echo e(__('Title')); ?></label>
                                        <input type="text" class="form-control"  id="title" name="title" value="<?php echo e($job_post->title); ?>" placeholder="<?php echo e(__('Title')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="slug"><?php echo e(__('Slug')); ?></label>
                                        <input type="text" class="form-control"  id="slug" name="slug" value="<?php echo e($job_post->slug); ?>" placeholder="<?php echo e(__('Slug')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="position"><?php echo e(__('Job Position')); ?></label>
                                        <input type="text" class="form-control"  id="position" name="position" value="<?php echo e($job_post->position); ?>" placeholder="<?php echo e(__('Position')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="company_name"><?php echo e(__('Company Name')); ?></label>
                                        <input type="text" class="form-control"  id="company_name" value="<?php echo e($job_post->company_name); ?>"  name="company_name" placeholder="<?php echo e(__('Company Name')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="category"><?php echo e(__('Category')); ?></label>
                                        <select name="category_id" class="form-control" id="category">
                                            <option value=""><?php echo e(__("Select Category")); ?></option>
                                            <?php $__currentLoopData = $all_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if($job_post->category_id == $category->id): ?> selected <?php endif; ?> value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="vacancy"><?php echo e(__('Vacancy')); ?></label>
                                        <input type="text" class="form-control"  id="vacancy" value="<?php echo e($job_post->vacancy); ?>" name="vacancy" placeholder="<?php echo e(__('Vacancy')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="job_context"><?php echo e(__('Job Context')); ?></label>
                                        <textarea name="job_context" id="job_context" class="form-control" cols="30" placeholder="<?php echo e(__('Job Context')); ?>" rows="10"><?php echo e($job_post->job_context); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="job_responsibility"><?php echo e(__('Job Responsibility')); ?></label>
                                        <textarea name="job_responsibility" id="job_responsibility" class="form-control" cols="30" placeholder="<?php echo e(__('Job Responsibility')); ?>" rows="10"><?php echo e($job_post->job_responsibility); ?></textarea>
                                        <small class="info-text"><?php echo e(__('separate responsibility by new line,  to separate them')); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="education_requirement"><?php echo e(__('Educational Requirements')); ?></label>
                                        <textarea name="education_requirement" id="education_requirement" class="form-control" cols="30" placeholder="<?php echo e(__('Educational Requirements')); ?>" rows="10"><?php echo e($job_post->education_requirement); ?></textarea>
                                        <small class="info-text"><?php echo e(__('separate responsibility by new line,  to separate them')); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="experience_requirement"><?php echo e(__('Experience Requirements')); ?></label>
                                        <textarea name="experience_requirement" id="experience_requirement" class="form-control" cols="30" placeholder="<?php echo e(__('Experience Requirements')); ?>" rows="10"><?php echo e($job_post->experience_requirement); ?></textarea>
                                        <small class="info-text"><?php echo e(__('separate responsibility by new line,  to separate them')); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="additional_requirement"><?php echo e(__('Additional Requirements')); ?></label>
                                        <textarea name="additional_requirement" id="additional_requirement" class="form-control" cols="30" placeholder="<?php echo e(__('Additional Requirements')); ?>" rows="10"><?php echo e($job_post->additional_requirement); ?></textarea>
                                        <small class="info-text"><?php echo e(__('separate responsibility by new line, to separate them')); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="employment_status"><?php echo e(__('Employment Status')); ?></label>
                                        <select name="employment_status" id="employment_status"  class="form-control">
                                            <option <?php if($job_post->employment_status == 'full_time'): ?> selected <?php endif; ?> value="full_time"><?php echo e(__('Full-Time')); ?></option>
                                            <option <?php if($job_post->employment_status == 'part_time'): ?> selected <?php endif; ?> value="part_time"><?php echo e(__('Part-Time')); ?></option>
                                            <option <?php if($job_post->employment_status == 'project_based'): ?> selected <?php endif; ?> value="project_based"><?php echo e(__('Project Based')); ?></option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="job_location"><?php echo e(__('Job Location')); ?></label>
                                        <input type="text" class="form-control"  id="job_location" name="job_location" value="<?php echo e($job_post->job_location); ?>" placeholder="<?php echo e(__('Job Location')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="other_benefits"><?php echo e(__('Compensation & Other Benefits')); ?></label>
                                        <textarea name="other_benefits" id="other_benefits" class="form-control" cols="30" placeholder="<?php echo e(__('Compensation & Other Benefits')); ?>" rows="10"><?php echo e($job_post->other_benefits); ?></textarea>
                                        <small class="info-text"><?php echo e(__('separate responsibility by new line, to separate them')); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="salary"><?php echo e(__('Salary')); ?></label>
                                        <input type="text" class="form-control"  id="salary" name="salary" value="<?php echo e($job_post->salary); ?>" placeholder="<?php echo e(__('Salary')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="deadline"><?php echo e(__('Deadline')); ?></label>
                                        <input type="date" class="form-control"  id="deadline" value="<?php echo e($job_post->deadline); ?>" name="deadline" placeholder="<?php echo e(__('Deadline')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="is_featured"><strong><?php echo e(__('Is Featured')); ?></strong></label>
                                        <label class="switch ">
                                            <input type="checkbox" <?php if($job_post->is_featured == 'on'): ?> checked <?php endif; ?> name="is_featured" id="is_featured">
                                            <span class="slider onff"></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_title"><?php echo e(__('Meta Title')); ?></label>
                                        <input type="text" name="meta_title"  class="form-control"  value="<?php echo e($job_post->meta_tags); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_tags"><?php echo e(__('Meta Tags')); ?></label>
                                        <input type="text" name="meta_tags"  class="form-control" value="<?php echo e($job_post->meta_tags); ?>" data-role="tagsinput" id="meta_tags">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description"><?php echo e(__('Meta Description')); ?></label>
                                        <textarea name="meta_description"  class="form-control" rows="5" id="meta_description"><?php echo e($job_post->meta_description); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="company_logo"><?php echo e(__('Company Logo')); ?></label>
                                        <div class="media-upload-btn-wrapper">
                                            <div class="img-wrap">
                                                <?php
                                                    $blog_img = get_attachment_image_by_id($job_post->company_logo,null,true);
                                                    $blog_image_btn_label = 'Upload Image';
                                                ?>
                                                <?php if(!empty($blog_img)): ?>
                                                    <div class="attachment-preview">
                                                        <div class="thumbnail">
                                                            <div class="centered">
                                                                <img class="avatar user-thumb" src="<?php echo e($blog_img['img_url']); ?>" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php  $blog_image_btn_label = 'Change Image'; ?>
                                                <?php endif; ?>
                                            </div>
                                            <input type="hidden" name="company_logo" value="<?php echo e($job_post->company_logo); ?>">
                                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal" data-target="#media_upload_modal">
                                                <?php echo e($blog_image_btn_label); ?>

                                            </button>
                                        </div>
                                        <small><?php echo e(__('Recommended image size 80x80')); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="status"><?php echo e(__('Status')); ?></label>
                                        <select name="status" id="status"  class="form-control">
                                            <option <?php if($job_post->status == 'publish'): ?> selected <?php endif; ?> value="publish"><?php echo e(__('Publish')); ?></option>
                                            <option <?php if($job_post->status == 'draft'): ?> selected <?php endif; ?> value="draft"><?php echo e(__('Draft')); ?></option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Job Details')); ?></button>
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

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\dizzcox-update\@core\resources\views/backend/jobs/edit-job.blade.php ENDPATH**/ ?>