<?php $__env->startSection('main_content'); ?>
    <!--================ Home Banner Area =================-->
    <section class="container box-1420">
        <div class="home-banner-area">
            <div class="banner-inner">
                <div class="banner-content">
                    <h5>The Ultimate Education ERP</h5>
                    <h2>Infix</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <a class="primary-btn fix-gr-bg semi-large" href="#">Learn More About Us</a>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Home Banner Area =================-->

    <!--================ News Area =================-->
    <section class="news-area section-gap-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-6 col-md-7">
                            <h3 class="title">Latest News</h3>
                        </div>
                        <div class="col-lg-6 col-md-5 text-md-right text-left mb-30-lg">
                            <a href="#" class="primary-btn small fix-gr-bg">Browse All</a>
                        </div>
                    </div>
                    <div class="row">
                          <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4 col-md-6">
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

                <div class="col-lg-3 notice-board-area">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="title">Notice Board</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="notice-board">
                                <?php $__currentLoopData = $notice_board; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="notice-item">
                                    <p class="date"><?php echo e(date('jS M, Y', strtotime($notice->publish_on))); ?></p>
                                    <h4><?php echo e($notice->notice_title); ?></h4>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End News Area =================-->

    <!--================ Academics Area =================-->
    <section class="academics-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-7">
                            <h3 class="title">Academics</h3>
                        </div>
                        <div class="col-lg-6 col-md-5 text-md-right text-left mb-30-lg">
                            <a href="#" class="primary-btn small fix-gr-bg">Browse All</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="academic-item">
                                <div class="academic-img">
                                    <img class="img-fluid" src="<?php echo e(asset('public/backEnd/img/client/academics/academic1.jpg')); ?>" alt="">
                                </div>
                                <div class="academic-text">
                                    <h4>
                                        <a href="#">Under Graduate Education</a>
                                    </h4>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adip isicing elit, sed do eiusmod tempor.
                                    </p>
                                    <div>
                                        <a href="#" class="client-btn">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="academic-item">
                                <div class="academic-img">
                                    <img class="img-fluid" src="<?php echo e(asset('public/backEnd/img/client/academics/academic2.jpg')); ?>" alt="">
                                </div>
                                <div class="academic-text">
                                    <h4>
                                        <a href="#">Under Graduate Education</a>
                                    </h4>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adip isicing elit, sed do eiusmod tempor.
                                    </p>
                                    <div>
                                        <a href="#" class="client-btn">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="academic-item">
                                <div class="academic-img">
                                    <img class="img-fluid" src="<?php echo e(asset('public/backEnd/img/client/academics/academic3.jpg')); ?>" alt="">
                                </div>
                                <div class="academic-text">
                                    <h4>
                                        <a href="#">Under Graduate Education</a>
                                    </h4>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adip isicing elit, sed do eiusmod tempor.
                                    </p>
                                    <div>
                                        <a href="#" class="client-btn">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Academics Area =================-->

    <!--================ Events Area =================-->
    <section class="events-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-7">
                            <h3 class="title">Event List</h3>
                        </div>
                        <div class="col-lg-6 col-md-5 text-md-right text-left mb-30-lg">
                            <a href="#" class="primary-btn small fix-gr-bg">Browse All</a>
                        </div>
                    </div>
                    <div class="row">
                        <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="events-item">
                                <div class="card">
                                    <img class="card-img-top" class="img-fluid" src="<?php echo e(asset($event->uplad_image_file)); ?>" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <?php echo e($event->event_title); ?>

                                        </h5>
                                        <p class="card-text">
                                            <?php echo e($event->event_location); ?>

                                        </p>
                                        <div class="date">
                                            <?php echo e(date('jS M', strtotime($event->from_date))); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Events Area =================-->

    <!--================ Start Testimonial Area =================-->
    <section class="testimonial-area relative section-gap">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="active-testimonial owl-carousel">

                     <?php $__currentLoopData = $testimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="single-testimonial text-center">
                        <div class="d-flex justify-content-center">
                            <div class="thumb">
                                <?php if(!empty($value->image)): ?>
                                <img class="img-fluid rounded-circle" src="<?php echo e(asset($value->image)); ?>" alt="">
                                    <?php else: ?>
                                    <img class="img-fluid rounded-circle" src="<?php echo e(asset('public/uploads/sample.jpg')); ?>" alt="">
                                    <?php endif; ?>
                            </div>
                            <div class="meta text-left">
                                <h4><?php echo e($value->name); ?></h4>
                                <p><?php echo e($value->designation); ?>, <?php echo e($value->institution_name); ?></p>
                            </div>
                        </div>
                        <p class="desc">
                            <?php echo e($value->description); ?>

                        </p>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Testimonial Area =================-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontEnd.home.front_master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>