
<footer class="footer-area home-page-<?php echo e(get_static_option('home_page_variant')); ?> <?php if(request()->routeIs('homepage')): ?> is-homepage <?php else: ?> inner-page <?php endif; ?>">
    <?php if(count($footer_widgets) > 0): ?>
    <div class="footer-top padding-top-100 padding-bottom-65">
        <div class="container">
            <div class="row">
                <?php $__currentLoopData = $footer_widgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo call_user_func_array($data->frontend_render_function,['id' => $data->id]); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-area-inner">
                        <?php echo render_footer_copyright_text(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="back-to-top">
    <i class="fas fa-angle-up"></i>
</div>

<?php if(!empty(get_static_option('product_module_status')) && request()->path() != 'user-home' && !request()->is('user-home/*') && cart_total_items() > 0 || request()->path() == get_static_option('product_page_slug')): ?>
    <a href="<?php echo e(route('frontend.products.cart')); ?>">
        <div class="cart-icon-wrap">
            <i class="fas fa-shopping-basket"></i>
            <div class="badge"><?php echo e(cart_total_items()); ?></div>
        </div>
    </a>
<?php endif; ?>

<?php if(!empty(get_static_option('popup_enable_status') && !empty(get_static_option('popup_selected_'.$user_select_lang_slug.'_id')))): ?>
    <?php
        $popup_id = get_static_option('popup_selected_'.$user_select_lang_slug.'_id');

        $popup_details = \App\PopupBuilder::find($popup_id);
        $website_url = url('/');
        if (preg_match('/(xgenious)/',$website_url)){
            $popup_details = \App\PopupBuilder::where('lang',$user_select_lang_slug)->inRandomOrder()->first();
        }
        if(!empty($popup_details)){
            $popup_class = '';
            if ($popup_details->type == 'notice'){
                $popup_class = 'notice-modal';
            }elseif($popup_details->type == 'only_image'){
                $popup_class = 'only-image-modal';
            }elseif($popup_details->type == 'promotion'){
                $popup_class = 'promotion-modal';
            }else{
                $popup_class = 'discount-modal';
            }
        }
    ?>
    <?php echo $__env->make('frontend.partials.popup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<!-- jquery -->
<script src="<?php echo e(asset('assets/frontend/js/lazyloadimage.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jquery-3.4.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jquery-migrate-3.1.0.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/dynamic-script.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jquery.magnific-popup.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/imagesloaded.pkgd.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/isotope.pkgd.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jquery.waypoints.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jquery.counterup.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/owl.carousel.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/wow.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jquery.ihavecookies.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/main.js')); ?>"></script>
<script src="<?php echo e(asset('assets/common/js/countdown.jquery.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/toastr.min.js')); ?>"></script>
<?php if(get_static_option('home_page_variant') == '09'): ?>
<script src="<?php echo e(asset('assets/frontend/js/jQuery.rProgressbar.min.js')); ?>"></script>
<?php endif; ?>
<?php if(!empty(get_static_option('popup_enable_status') && !empty(get_static_option('popup_selected_'.$user_select_lang_slug.'_id')))): ?>
<script src="<?php echo e(asset('assets/common/js/countdown.jquery.js')); ?>"></script>
<?php endif; ?>
<script>
    (function($){
        "use strict";
        $(document).ready(function(){
            function getCookie(cname) {
                var name = cname + "=";
                var decodedCookie = decodeURIComponent(document.cookie);
                var ca = decodedCookie.split(';');
                for (var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                return "";
            }

            function setCookie(cname, cvalue, exdays) {
                var d = new Date();
                d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                var expires = "expires=" + d.toUTCString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            }
            <?php if(!empty(get_static_option('popup_enable_status') && !empty(get_static_option('popup_selected_'.$user_select_lang_slug.'_id'))) && !empty($popup_details)): ?>

            var delayTime = "<?php echo e(get_static_option('popup_delay_time')); ?>";
            delayTime = delayTime ? delayTime : 4000;

            if (getCookie('nx_popup_show') == '') {
                setTimeout(function () {
                    $('.nx-popup-backdrop').addClass('show');
                    $('.nx-popup-wrapper').addClass('show');

                }, parseInt(delayTime));
            }

            $(document).on('click', '.nx-popup-close,.nx-popup-backdrop', function (e) {
                e.preventDefault();
                $('.nx-modal-content').html('');
                $('.nx-popup-backdrop').removeClass('show');
                $('.nx-popup-wrapper').removeClass('show');
                setCookie('nx_popup_show', 'no', 1);
            });

            var offerTime = "<?php echo e($popup_details->offer_time_end); ?>";
            var year = offerTime.substr(0, 4);
            var month = offerTime.substr(5, 2);
            var day = offerTime.substr(8, 2);
            if (offerTime) {
                $('#countdown').countdown({
                    year: year,
                    month: month,
                    day: day,
                    labels: true,
                    labelText: {
                        'days': "<?php echo e(__('days')); ?>",
                        'hours': "<?php echo e(__('hours')); ?>",
                        'minutes': "<?php echo e(__('min')); ?>",
                        'seconds': "<?php echo e(__('sec')); ?>",
                    }
                });
            }
            <?php endif; ?>


            <?php if(get_static_option('home_page_variant') == '07'): ?>
            var offerTime = $('#featured_event_countdown').data('time');
            var year = offerTime.substr(0, 4);
            var month = offerTime.substr(5, 2);
            var day = offerTime.substr(8, 2);
            if (offerTime) {
                $('#featured_event_countdown').countdown({
                    year: year,
                    month: month,
                    day: day,
                    labels: true,
                    labelText: {
                        'days': "<?php echo e(__('days')); ?>",
                        'hours': "<?php echo e(__('hours')); ?>",
                        'minutes': "<?php echo e(__('min')); ?>",
                        'seconds': "<?php echo e(__('sec')); ?>",
                    }
                });
            }
            <?php endif; ?>
            <?php if(get_static_option('home_page_variant') == '09'): ?>
            var allProgress =  $('.donation-progress');
            $.each(allProgress,function (index, value) {
                $(this).rProgressbar({
                    percentage: $(this).data('percent'),
                    fillBackgroundColor: "#2685f9"
                });
            });
            <?php endif; ?>
            $(document).on('click','.language_dropdown ul li',function(e){
                var el = $(this);
                el.parent().parent().find('.selected-language').text(el.text());
                el.parent().removeClass('show');
                $.ajax({
                    url : "<?php echo e(route('frontend.langchange')); ?>",
                    type: "GET",
                    data:{
                        'lang' : el.data('value')
                    },
                    success:function (data) {
                        location.reload();
                    }
                })
            });

            $(document).on('click', '.newsletter-form-wrap .submit-btn', function (e) {
                e.preventDefault();
                var email = $('.newsletter-form-wrap input[type="email"]').val();
                var errrContaner = $(this).parent().parent().parent().find('.form-message-show');
                errrContaner.html('');

                $.ajax({
                    url: "<?php echo e(route('frontend.subscribe.newsletter')); ?>",
                    type: "POST",
                    data: {
                        _token: "<?php echo e(csrf_token()); ?>",
                        email: email
                    },
                    success: function (data) {
                        errrContaner.html('<div class="alert alert-'+data.type+'">' + data.msg + '</div>');
                    },
                    error: function (data) {
                        var errors = data.responseJSON.errors;
                        errrContaner.html('<div class="alert alert-danger">' + errors.email[0] + '</div>');
                    }
                });
            });
        });
    }(jQuery));
</script>

<?php echo $__env->yieldContent('scripts'); ?>
<?php if(!empty(get_static_option('tawk_api_key'))): ?>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src="https://embed.tawk.to/<?php echo e(get_static_option('tawk_api_key')); ?>/default";
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<?php endif; ?>
<?php if(!empty(get_static_option('site_gdpr_cookie_enabled'))): ?>
    <?php $gdpr_cookie_link = str_replace('{url}',url('/'),get_static_option('site_gdpr_cookie_'.$user_select_lang_slug.'_more_info_link')) ?>
<script>
    $(document).ready(function () {
        $('body').ihavecookies({
            title: "<?php echo e(get_static_option("site_gdpr_cookie_" . $user_select_lang_slug . "_title")); ?>",
            message: "<?php echo e(get_static_option('site_gdpr_cookie_'.$user_select_lang_slug.'_message')); ?>",
            expires: "<?php echo e(get_static_option('site_gdpr_cookie_expire')); ?>" ,
            link: "<?php echo e($gdpr_cookie_link); ?>",
            delay: "<?php echo e(get_static_option('site_gdpr_cookie_delay')); ?>",
            moreInfoLabel: "<?php echo e(get_static_option('site_gdpr_cookie_'.$user_select_lang_slug.'_more_info_label')); ?>",
            acceptBtnLabel: "<?php echo e(get_static_option('site_gdpr_cookie_'.$user_select_lang_slug.'_accept_button_label')); ?>",
            advancedBtnLabel: "<?php echo e(get_static_option('site_gdpr_cookie_'.$user_select_lang_slug.'_decline_button_label')); ?>"
        });
        $('body').on('click','#gdpr-cookie-close',function (e) {
            e.preventDefault();
            $(this).parent().remove();
        });
    });
</script>
<?php endif; ?>
<?php if(get_static_option('home_page_variant') == '08'): ?>
    <script>
        $(document).ready(function (){
            "use strict";

            $(document).on('click','.ajax_add_to_cart',function (e) {
                e.preventDefault();
                var allData = $(this).data();
                var el = $(this);
                $.ajax({
                    url : "<?php echo e(route('frontend.products.add.to.cart.ajax')); ?>",
                    type: "POST",
                    data: {
                        _token : "<?php echo e(csrf_token()); ?>",
                        'product_id' : allData.product_id,
                        'quantity' : allData.product_quantity,
                    },
                    beforeSend: function(){
                        el.text("<?php echo e(__('Adding')); ?>");
                    },
                    success: function (data) {

                        el.html('<i class="fa fa-shopping-bag" aria-hidden="true"></i>'+"<?php echo e(get_static_option('product_add_to_cart_button_'.$user_select_lang_slug.'_text')); ?>");
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "2000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        toastr.success(data.msg);

                        $('.navbar-area .nav-container .nav-right-content ul li.cart .pcount,.cart-icon-wrap .badge').text(data.total_cart_item);
                    }
                });
            });
        });
    </script>
<?php endif; ?>

</body>

</html><?php /**PATH /Users/dvrobin/Desktop/Sharifur-Backup/localhost/bizzcox/@core/resources/views/frontend/partials/footer.blade.php ENDPATH**/ ?>