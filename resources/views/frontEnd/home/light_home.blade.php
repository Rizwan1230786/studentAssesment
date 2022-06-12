@extends('frontEnd.home.front_master')
@section('main_content')
    <!--================ Home Banner Area =================-->
    <section class="container-fluid box-1420">
        <div class="home-banner-area">
            <div class="banner-inner">
                <div class="banner-content">
                    <h5>The Ultimate Education ERP</h5>
                    <h2 style="font-size: 40px;margin-top: 30px; margin-bottom: 30px;">Student Assessment System</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                        et dolore magna aliqua.</p>
                    <a class="primary-btn fix-gr-bg semi-large" href="{{ url('about') }}">Learn More About Us</a>
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
                            <a href="{{ url('news-page') }}" class="primary-btn small fix-gr-bg">Browse All</a>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($news as $value)
                            <div class="col-lg-4 col-md-6">
                                <div class="news-item">
                                    <div class="news-img">
                                        <img class="img-fluid w-100" src="{{ asset($value->image) }}" alt="">
                                    </div>
                                    <div class="news-text">
                                        <p class="date">{{ date('jS M, Y', strtotime($value->publish_date)) }}
                                        </p>
                                        <h4>
                                            <a href="{{ url('news-details/' . $value->id) }}">
                                                {{ $value->news_title }}
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
                                @foreach ($notice_board as $notice)
                                    <div class="notice-item">
                                        <p class="date">{{ date('jS M, Y', strtotime($notice->publish_on)) }}
                                        </p>
                                        <h4>{{ $notice->notice_title }}</h4>
                                    </div>
                                @endforeach
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
                            <a href="{{ url('course') }}" class="primary-btn small fix-gr-bg">Browse All</a>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($academics as $academic)
                            <div class="col-lg-4 col-md-6">
                                <div class="academic-item">
                                    <div class="academic-img">
                                        <img class="img-fluid" src="{{ asset($academic->image) }}" alt="">
                                    </div>
                                    <div class="academic-text">
                                        <h4>
                                            <a
                                                href="{{ url('course-Details/' . $academic->id) }}">{{ $academic->title }}</a>
                                        </h4>
                                        <p>
                                            {!! substr($academic->overview, 0, 50) !!}
                                        </p>
                                        <div>
                                            <a href="{{ url('course-Details/' . $academic->id) }}"
                                                class="client-btn">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Academics Area =================-->

    <!--================ Events Area =================-->
    <section>
        <div class="container com-sp pad-bot-70">
            <div class="con-title">
                <h1>
                    <i class="fa fa-graduation-cap"></i> Students News Feed
                </h1>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ed-course">
                        <div class="row">
                            <div class="col-lg-3 col-sm-4 col-xs-12">
                                <div class="ed-course-in">
                                    <a class="course-overlay"
                                        href="https://admissions.kfueit.edu.pk/downloads/vouchers/student-id-card?reg=inft18111056">
                                        <img src="images/prin2.jpg" alt="">
                                        <span>Download ID Card Fee Voucher</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <div class="ed-course-in">
                                    <a class="course-overlay" href="/rollnoslip">
                                        <img src="images/h-adm1.jpg" alt="">
                                        <span>View My RollNo Slip</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <div class="ed-course-in">
                                    <a class="course-overlay" href="./transcript">
                                        <img src="images/transcript.jpg.jpg" alt="">
                                        <span>View My Transcript</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <div class="ed-course-in">
                                    <a class="course-overlay" href="/planofstudy">
                                        <img src="images/studyplan.jpg" alt="">
                                        <span>View My Plan Of Study</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <div class="ed-course-in">
                                    <a class="course-overlay" href="/currentenrollments">
                                        <img src="images/enrollment.jpg" alt="">
                                        <span>Viw My Current Enrollments</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <div class="ed-course-in">
                                    <a class="course-overlay" href="/feevoucher">
                                        <img src="images/voucher.jpg" alt="">
                                        <span>Download Semester Fee Voucher</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <div class="ed-course-in">
                                    <a class="course-overlay" href="/Pastpaper">
                                        <img src="images/guess.png" alt="">
                                        <span>View Guesses About Exams</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <div class="ed-course-in">
                                    <a class="course-overlay" href="/Application">
                                        <img src="images/Application.jpg" alt="">
                                        <span>Application Form</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <div class="ed-course-in">
                                    <a class="course-overlay" href="/Clearance">
                                        <img src="images/Clear.jpg" alt="">
                                        <span>My Clearance</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <div class="ed-course-in">
                                    <a class="course-overlay" href="/Medical">
                                        <img src="images/Med.jpg" alt="">
                                        <span>Medical Profile</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                        @foreach ($events as $event)
                            <div class="col-lg-3 col-md-6">
                                <div class="events-item">
                                    <div class="card">
                                        <img class="card-img-top" class="img-fluid"
                                            src="{{ asset($event->uplad_image_file) }}" alt="">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                {{ $event->event_title }}
                                            </h5>
                                            <p class="card-text">
                                                {{ $event->event_location }}
                                            </p>
                                            <div class="date">
                                                {{ date('jS M', strtotime($event->from_date)) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

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

                    @foreach ($testimonial as $value)
                        {{-- {{dd($value->image)}} --}}
                        <div class="single-testimonial text-center">
                            <div class="d-flex justify-content-center">
                                <div class="thumb">
                                    @if (!empty($value->image))
                                        <img class="img-fluid rounded-circle" src="{{ asset($value->image) }}" alt="">
                                    @else
                                        <img class="img-fluid rounded-circle"
                                            src="{{ asset('public/uploads/sample.jpg') }}" alt="">
                                    @endif
                                </div>
                                <div class="meta text-left">
                                    <h4>{{ $value->name }}</h4>
                                    <p>{{ $value->designation }}, {{ $value->institution_name }}</p>
                                </div>
                            </div>
                            <p class="desc">
                                {{ $value->description }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!--================ End Testimonial Area =================-->
@endsection
