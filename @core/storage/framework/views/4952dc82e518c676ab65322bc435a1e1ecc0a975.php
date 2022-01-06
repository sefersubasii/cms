<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Section Manage')); ?>

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
                        <h4 class="header-title"><?php echo e(__('Section Manage')); ?></h4>
                        <form action="<?php echo e(route('admin.knowledge.home.section.manage')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_support_bar_section_status"><strong><?php echo e(__('Topbar Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_support_bar_section_status"  <?php if(!empty(get_static_option('home_page_support_bar_section_status'))): ?> checked <?php endif; ?> >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="knowledgebase_home_page_highlight_box_section_status"><strong><?php echo e(__('Highlight Box Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="knowledgebase_home_page_highlight_box_section_status"  <?php if(!empty(get_static_option('knowledgebase_home_page_highlight_box_section_status'))): ?> checked <?php endif; ?> >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="knowledgebase_home_page_popular_article_section_status"><strong><?php echo e(__('Popular Article Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="knowledgebase_home_page_popular_article_section_status"  <?php if(!empty(get_static_option('knowledgebase_home_page_popular_article_section_status'))): ?> checked <?php endif; ?> >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="knowledgebase_home_page_testimonial_section_status"><strong><?php echo e(__('Testimonial Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="knowledgebase_home_page_testimonial_section_status"  <?php if(!empty(get_static_option('knowledgebase_home_page_testimonial_section_status'))): ?> checked <?php endif; ?> >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="knowledgebase_home_page_faq_section_status"><strong><?php echo e(__('Faq Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="knowledgebase_home_page_faq_section_status"  <?php if(!empty(get_static_option('knowledgebase_home_page_faq_section_status'))): ?> checked <?php endif; ?> >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="knowledgebase_home_page_team_section_status"><strong><?php echo e(__('Team Member Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="knowledgebase_home_page_team_section_status"  <?php if(!empty(get_static_option('knowledgebase_home_page_team_section_status'))): ?> checked <?php endif; ?> >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="knowledgebase_home_page_cta_section_status"><strong><?php echo e(__('Call To Action Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="knowledgebase_home_page_cta_section_status"  <?php if(!empty(get_static_option('knowledgebase_home_page_cta_section_status'))): ?> checked <?php endif; ?> >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
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


<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/@core/resources/views/backend/pages/home/knowledge-home/section-manage.blade.php ENDPATH**/ ?>