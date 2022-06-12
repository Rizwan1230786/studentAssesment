<?php $__env->startSection('main_content'); ?>
    <!--================ Home Banner Area =================-->
    <section class="container box-1420">
        <div class="banner-area">
            <div class="banner-inner">
                <div class="banner-content">
                    <h2>Courses</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <a class="primary-btn fix-gr-bg semi-large" href="<?php echo e(url('about')); ?>">Learn More About Us</a>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Home Banner Area =================-->

    <!--================ Course List Area =================-->
    <section class="academics-area section-gap-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="title">Course List</h3>
                        </div>
                    </div>
                    <div class="row">
                        <?php $__currentLoopData = $course; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="academic-item">
                                <div class="academic-img">
                                    <img class="img-fluid" src="<?php echo e(asset($value->image)); ?>" alt="">
                                </div>
                                <div class="academic-text">
                                    <h4>
                                        <a href="<?php echo e(url('course-Details/'.$value->id)); ?>"><?php echo e($value->title); ?></a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

            <div class="row text-center mt-30">
                <div class="col-lg-12">
                    <a class="primary-btn fix-gr-bg semi-large" href="#">Load More Courses</a>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Course List Area =================-->

    <!--================ News Area =================-->
    <section class="news-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="title">Latest News</h3>
                        </div>
                    </div>
                    <div class="row">
                        <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="news-item">
                                <div class="news-img">
                                    <img class="img-fluid w-100" src="<?php echo e(asset($value->image)); ?>" alt="">
                                </div>
                                <div class="news-text">
                                    <p class="date"><?php echo e(date('jS M, Y', strtotime($value->publish_date))); ?></p>
                                    <h4>
                                        <a href="<?php echo e(url('news-details/'.$value->id)); ?>">
                                            <?php echo e($value->news_title); ?>

                                        </a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End News Area =================-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontEnd.home.front_master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>