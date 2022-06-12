<?php

    if(Auth::user()->role_id != 1 && Auth::user()->role_id != 3){
        $notifications = App\SmNotification::notifications();
    }else{
        $notifications = [];
    }


?>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">

        <button type="button" id="sidebarCollapse" class="btn d-lg-none">
            <i class="fa fa-dashboard"></i>
        </button>
        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fa fa-align-justify"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav mr-auto search-bar">
                <li class="">
                    <div class="input-group">
                        <span>
                            <i class="ti-search" aria-hidden="true" id="search-icon"></i>
                        </span>
                        <input type="text" class="form-control primary-input input-left-icon" placeholder="Search"
                            id="search" />
                        <span class="focus-border"></span>
                    </div>
                </li>
            </ul>

            <ul class="nav navbar-nav mr-auto nav-buttons flex-sm-row">
                <li class="nav-item">
                    <a class="primary-btn white mr-10" href="<?php echo e(url('/')); ?>/home"><?php echo app('translator')->getFromJson('lang.website'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="primary-btn white mr-10" href="<?php echo e(url('/admin-dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                </li>
                <li class="nav-item">
                    <a class="primary-btn white" href="<?php echo e(url('/student-report')); ?>"><?php echo app('translator')->getFromJson('lang.reports'); ?></a>
                </li>
            </ul>

            <ul class="nav navbar-nav mr-auto nav-setting flex-sm-row">
                
                <li class="nav-item">

                    <select class="niceSelect languageChange" name="languageChange" id="languageChange">

                        <?php $languages = App\SmGeneralSettings::getLanguageList(); ?>
                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                            <option data-display="<?php echo e($lang->native); ?>" value="<?php echo e(URL::to('/locale/'.$lang->language_universal)); ?>"><?php echo e($lang->native); ?></option> 
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </select>
                </li>
            </ul>


            <!-- Start Right Navbar -->
            <ul class="nav navbar-nav right-navbar">
                

                <!-- <li class="nav-item">
                    <div class="dropdown">
                        <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="flaticon-user"></span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Link 1</a>
                            <a class="dropdown-item" href="#">Link 2</a>
                            <a class="dropdown-item-text" href="#">Text Link</a>
                            <span class="dropdown-item-text">Just Text</span>
                        </div>
                    </div>
                </li> -->

                <li class="nav-item notification-area">
                    <div class="dropdown">
                        <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="badge"><?php echo e(count($notifications) < 10? count($notifications):$notifications->count()); ?></span>
                            <span class="flaticon-notification"></span>
                        </button>
                        <div class="dropdown-menu">
                            <div class="white-box">
                                <div class="p-h-20">
                                    <p class="notification"><?php echo app('translator')->getFromJson('lang.you_have'); ?> <span><?php echo e(count($notifications) < 10? count($notifications):count($notifications)); ?> <?php echo app('translator')->getFromJson('lang.new'); ?></span>
                                        <?php echo app('translator')->getFromJson('lang.notification'); ?></p>
                                </div>
                                <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                                <a class="dropdown-item pos-re" href="<?php echo e(url('view/single/notification/'.$notification->id)); ?>">
                                <div class="single-message single-notifi">
                                    <div class="d-flex">
                                        <span class="ti-bell"></span>
                                        <div class="d-flex align-items-center ml-10">
                                            <div class="mr-60">
                                                <p class="message"><?php echo e($notification->message); ?></p>
                                            </div>
                                        <div class="mr-10 text-right bell_time">
                                            <p class="time text-uppercase"><?php echo e(date("h.i a", strtotime($notification->created_at))); ?></p>
                                            <p class="date"><?php echo e(date('jS M', strtotime($notification->date))); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <a href="<?php echo e(url('view/all/notification/'.Auth()->user()->id)); ?>" class="primary-btn text-center text-uppercase mark-all-as-read">
                                    <?php echo app('translator')->getFromJson('lang.mark_all_as_read'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item setting-area">
                    <div class="dropdown">
                        <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                            <img class="rounded-circle" src="<?php echo e(asset('public/backEnd/img/')); ?>/admin/avatar.png" alt="">
                        </button>
                        <div class="dropdown-menu profile-box">
                            <div class="white-box">
                                <a class="dropdown-item" href="#">
                                    <div class="">
                                        <div class="d-flex">
                                            <img class="client_img" src="<?php echo e(asset('public/backEnd/img/')); ?>/admin/message-thumb.png"
                                                alt="">
                                            <div class="d-flex ml-10">
                                                <div class="">
                                                    <h5 class="name text-uppercase"><?php echo e(Auth::user()->full_name); ?></h5>
                                                    <p class="message"><?php echo e(Auth::user()->email); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <ul class="list-unstyled">
                                    <li>
                                        <?php if(Auth::user()->role_id == "2"): ?>
                                        <a href="<?php echo e(route('student_view', Auth::user()->student->id)); ?>">
                                            <span class="ti-user"></span>
                                            <?php echo app('translator')->getFromJson('lang.view_profile'); ?>
                                        </a>
                                        <?php elseif(Auth::user()->role_id != "3"): ?>
                                        <a href="<?php echo e(route('viewStaff', Auth::user()->staff->id)); ?>">
                                            <span class="ti-user"></span>
                                            <?php echo app('translator')->getFromJson('lang.view_profile'); ?>
                                        </a>
                                        <?php endif; ?>
                                    </li>

                                    <li>
                                        <a href="<?php echo e(url('change-password')); ?>">
                                            <span class="ti-key"></span>
                                            <?php echo app('translator')->getFromJson('lang.password'); ?>
                                        </a>
                                    </li> 
                                    <li>

                                        <a href="<?php echo e(Auth::user()->role_id == 2? route('student-logout'): route('logout')); ?>" onclick="event.preventDefault();

                                                     document.getElementById('logout-form').submit();">
                                            <span class="ti-unlock"></span>
                                            logout
                                        </a>

                                        <form id="logout-form" action="<?php echo e(Auth::user()->role_id == 2? route('student-logout'): route('logout')); ?>" method="POST" style="display: none;">

                                            <?php echo csrf_field(); ?>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <!-- End Right Navbar -->
        </div>
    </div>
</nav>


<?php $__env->startSection('script'); ?>

<script>

    $('#languageChange').on('change', function() {
        var str = $('#languageChange').val();
        window.location.href =str;
    });

</script>
<?php $__env->stopSection(); ?>
