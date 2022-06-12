<!DOCTYPE html>
<html lang="">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" href="<?php echo e(asset('public/backEnd/')); ?>/img/favicon.png" type="image/png" />
    <title>School Management System</title>
    <meta name="_token" content="<?php echo csrf_token(); ?>" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/jquery-ui.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/themify-icons.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/nice-select.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/magnific-popup.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/fastselect.min.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/owl.carousel.min.css" />
    <!-- main css -->
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/style.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/software.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/fullcalendar.min.css">
    <link rel="stylesheet" media="print" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.print.css">




</head>

<body class="client light">

<!--================ Start Header Menu Area =================-->
<header class="header-area">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container box-1420">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>/home">
                    <img class="w-75" src="<?php echo e(asset('public/backEnd/img/logo.png')); ?>" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="ti-menu"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="nav-item active"><a class="nav-link" href="<?php echo e(url('/')); ?>/home">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(url('/')); ?>/about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(url('/')); ?>/course">Course</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(url('/')); ?>/news-page">News</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(url('/')); ?>/contact">Contact</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <ul class="nav navbar-nav mr-auto search-bar">
                            <li class="">
                                <div class="input-group">
                                        <span>
                                            <i class="ti-search" aria-hidden="true" id="search-icon"></i>
                                        </span>
                                    <input type="text" class="form-control primary-input input-left-icon" placeholder="Search" id="search" />
                                    <span class="focus-border"></span>
                                </div>
                            </li>
                        </ul>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
<!--================ End Header Menu Area =================-->
<?php echo $__env->yieldContent('main_content'); ?>

<!--================Footer Area =================-->
<footer class="footer_area section-gap-top">
    <div class="container">
        <div class="row footer_inner">
            <div class="col-lg-3 col-sm-6">
                <aside class="f_widget ab_widget">
                    <div class="f_title">
                        <h4>Departments</h4>
                    </div>
                    <ul>
                        <li><a href="#"></a>Business</a></li><a href="#">
                            <li><a href="#"></a>Energy & Environmental Sciences</a></li>
                        <li><a href="#"></a>Education Engineering</a></li>
                        <li><a href="#"></a>Humanities & Sciences</a></li>
                        <li><a href="#"></a>Law and Medicine</a></li>
                    </ul>
                </aside>
            </div>
            <div class="col-lg-3 col-sm-6">
                <aside class="f_widget ab_widget">
                    <div class="f_title">
                        <h4>Health Care</h4>
                    </div>
                    <ul>
                        <li><a href="#"></a>Infix Health Care</a></li><a href="#">
                            <li><a href="#"></a>Infix Children’s Health</a></li>
                        <li><a href="#"></a>Interdisciplinary Research</a></li>
                        <li><a href="#"></a>Infix Online</a></li>
                        <li><a href="#"></a>Infix Research Centers</a></li>
                    </ul>
                </aside>
            </div>
            <div class="col-lg-3 col-sm-6">
                <aside class="f_widget ab_widget">
                    <div class="f_title">
                        <h4>About Infix</h4>
                    </div>
                    <ul>
                        <li><a href="#"></a>Infix Health Care</a></li><a href="#">
                            <li><a href="#"></a>Infix Children’s Health</a></li>
                        <li><a href="#"></a>Interdisciplinary Research</a></li>
                        <li><a href="#"></a>Infix Online</a></li>
                        <li><a href="#"></a>Infix Research Centers</a></li>
                    </ul>
                </aside>
            </div>
            <div class="col-lg-3 col-sm-6">
                <aside class="f_widget ab_widget">
                    <div class="f_title">
                        <h4>Resources</h4>
                    </div>
                    <ul>
                        <li><a href="#"></a>Business</a></li><a href="#">
                            <li><a href="#"></a>Energy & Environmental Sciences</a></li>
                        <li><a href="#"></a>Education Engineering</a></li>
                        <li><a href="#"></a>Humanities & Sciences</a></li>
                        <li><a href="#"></a>Law and Medicine</a></li>
                    </ul>
                </aside>
            </div>
        </div>
        <div class="row single-footer-widget">
            <div class="col-lg-8 col-md-9">
                <div class="copy_right_text">
                    <p>Copyright © 2018 All rights reserved <a href="#">Infix</a>. The Ultimate Education ERP</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-3">
                <div class="social_widget">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                    <a href="#"><i class="fa fa-behance"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--================End Footer Area =================-->

<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/jquery-3.2.1.min.js">
</script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/jquery-ui.js">
</script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/popper.js">
</script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/bootstrap.min.js">
</script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/nice-select.min.js">
</script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/jquery.magnific-popup.min.js">
</script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/raphael-min.js">
</script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/morris.min.js">
</script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
</script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/bootstrap-datepicker.min.js"></script>
<!-- <script src="<?php echo e(asset('public/backEnd/')); ?>/js/gmap3.min.js"></script> -->
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwzmSafhk_bBIdIy7MjwVIAVU1MgUmXY4"></script> -->

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDs3mrTgrYd6_hJS50x4Sha1lPtS2T-_JA"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/main.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/custom.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/developer.js"></script>

<?php echo $__env->yieldContent('script'); ?>

</body>
</html>

