<?php $__env->startSection('site-title'); ?>
    <?php echo e(get_static_option('blog_page_'.$user_select_lang_slug.'_title')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(get_static_option('blog_page_'.$user_select_lang_slug.'_title')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li><?php echo e(get_static_option('blog_page_'.$user_select_lang_slug.'_name')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e(get_static_option('blog_page_'.$user_select_lang_slug.'_meta_tags')); ?>">
    <meta name="tags" content="<?php echo e(get_static_option('blog_page_'.$user_select_lang_slug.'_meta_description')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <section class="blog-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <?php $__currentLoopData = $all_blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-6 col-md-6">
                                <div class="single-blog-grid-01 margin-bottom-30">
                                    <div class="thumb">
                                        <?php echo render_image_markup_by_attachment_id($data->image); ?>

                                    </div>
                                    <div class="content">
                                        <h4 class="title"><a href="<?php echo e(route('frontend.blog.single',$data->slug)); ?>"><?php echo e($data->title); ?></a></h4>
                                        <ul class="post-meta">
                                            <li><a href="<?php echo e(route('frontend.blog.single',$data->slug)); ?>"><i class="fa fa-calendar"></i> <?php echo e(date_format($data->created_at,'d M y')); ?></a></li>
                                            <li><a href="<?php echo e(route('frontend.blog.single',$data->slug)); ?>"><i class="fa fa-user"></i> <?php echo e(render_blog_author($data->author)); ?></a></li>
                                            <li>
                                                <div class="cats"><i class="fa fa-calendar"></i>
                                                    <?php echo get_blog_category_by_id($data->id,'link'); ?>

                                                </div>
                                            </li>
                                        </ul>
                                        <p><?php echo e($data->excerpt); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="col-lg-12">
                        <nav class="pagination-wrapper" aria-label="Page navigation ">
                           <?php echo e($all_blogs->links()); ?>

                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
                   <?php echo $__env->make('frontend.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/dizzcox/beta/@core/resources/views/frontend/pages/blogs/blog.blade.php ENDPATH**/ ?>