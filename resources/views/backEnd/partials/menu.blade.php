@php

    if(Auth::user()->role_id != 1 && Auth::user()->role_id != 3 && Auth::user()->role_id != 10){
        $notifications = App\SmNotification::notifications();
    }else{
        $notifications = [];
    }


    if(Auth::user()->role_id == 2){
    $LoginUser=App\SmStudent::where('user_id',Auth::user()->id)->first();
       if(empty($LoginUser)){
            $profile = 'public/backEnd/img/admin/message-thumb.png';
       }else{
            $profile = $LoginUser->student_photo;
       }
    }
    elseif (Auth::user()->role_id == 3){
    $LoginUser=App\SmParent::where('user_id',Auth::user()->id)->first();
       if(empty($LoginUser)){
            $profile = 'public/backEnd/img/admin/message-thumb.png';
       }else{
            $profile = $LoginUser->father_photo;
       }
    }

    else{
    $LoginUser=App\SmStaff::where('user_id',Auth::user()->id)->first();
       if(empty($LoginUser)){
            $profile = 'public/backEnd/img/admin/message-thumb.png';
       }else{
            $profile = $LoginUser->staff_photo;
       }
    }
 
 

 

@endphp
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
                               id="search"/>
                        <span class="focus-border"></span>
                    </div>
                </li>
            </ul>

            <ul class="nav navbar-nav mr-auto nav-buttons flex-sm-row">
                <li class="nav-item">
                    <a class="primary-btn white mr-10" href="{{url('/')}}/home">@lang('lang.website')</a>
                </li>
                <li class="nav-item">
                    <a class="primary-btn white mr-10" href="{{url('/admin-dashboard')}}">@lang('lang.dashboard')</a>
                </li>
                <li class="nav-item">
                    <a class="primary-btn white" href="{{url('/student-report')}}">@lang('lang.reports')</a>
                </li>
            </ul>

            <ul class="nav navbar-nav mr-auto nav-setting flex-sm-row">
                {{-- <li class="nav-item active">
                    <select class="niceSelect">
                        <option data-display="Styles">Styles</option>
                        <option value="1">Style 1</option>
                        <option value="2">Style 2</option>
                        <option value="4">Style 3</option>
                    </select>
                </li> --}}
                <li class="nav-item">

                    <select class="niceSelect languageChange" name="languageChange" id="languageChange">

                        @php $languages = App\SmGeneralSettings::getLanguageList(); @endphp
                        @foreach($languages as $lang)
                            <option data-display="{{$lang->native}}"
                                    value="{{URL::to('/locale/'.$lang->language_universal)}}">{{$lang->native}}</option>
                        @endforeach

                    </select>
                </li>
            </ul>


            <!-- Start Right Navbar -->
            <ul class="nav navbar-nav right-navbar"> 
                <li class="nav-item notification-area">
                    <div class="dropdown">
                        <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="badge">{{count($notifications) < 10? count($notifications):$notifications->count()}}</span>
                            <span class="flaticon-notification"></span>
                        </button>
                        <div class="dropdown-menu">
                            <div class="white-box">
                                <div class="p-h-20">
                                    <p class="notification">@lang('lang.you_have')
                                        <span>{{count($notifications) < 10? count($notifications):count($notifications)}} @lang('lang.new')</span>
                                        @lang('lang.notification')</p>
                                </div>
                                @foreach($notifications as $notification)


                                    <a class="dropdown-item pos-re"
                                       href="{{url('view/single/notification/'.$notification->id)}}">
                                        <div class="single-message single-notifi">
                                            <div class="d-flex">
                                                <span class="ti-bell"></span>
                                                <div class="d-flex align-items-center ml-10">
                                                    <div class="mr-60">
                                                        <p class="message">{{$notification->message}}</p>
                                                    </div>
                                                    <div class="mr-10 text-right bell_time">
                                                        <p class="time text-uppercase">{{date("h.i a", strtotime($notification->created_at))}}</p>
                                                        <p class="date">{{date('jS M', strtotime($notification->date))}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach

                                <a href="{{url('view/all/notification/'.Auth()->user()->id)}}"
                                   class="primary-btn text-center text-uppercase mark-all-as-read">
                                    @lang('lang.mark_all_as_read')
                                </a>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item setting-area">
                    <div class="dropdown">
                        <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                            <img class="rounded-circle" src="{{asset($profile)}}" alt="">
                        </button>
                        <div class="dropdown-menu profile-box">
                            <div class="white-box">
                                <a class="dropdown-item" href="#">
                                    <div class="">
                                        <div class="d-flex">
                                            <img class="client_img" src="{{asset($profile)}}" alt="">
                                            <div class="d-flex ml-10">
                                                <div class="">
                                                    <h5 class="name text-uppercase">{{Auth::user()->full_name}}</h5>
                                                    <p class="message">{{Auth::user()->email}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <ul class="list-unstyled">
                                    <li>
                                        @if(Auth::user()->role_id == "2")
                                            <a href="{{route('student_view', Auth::user()->student->id)}}">
                                                <span class="ti-user"></span>
                                                @lang('lang.view_profile')
                                            </a>
                                        @elseif(Auth::user()->role_id == "10")
                                            <a href="#">
                                                <span class="ti-user"></span>
                                                @lang('lang.view_profile')
                                            </a>

                                        @elseif(Auth::user()->role_id != "3")
                                            <a href="{{route('viewStaff', Auth::user()->staff->id)}}">
                                                <span class="ti-user"></span>
                                                @lang('lang.view_profile')
                                            </a>
                                        @endif
                                    </li>

                                    <li>
                                        <a href="{{url('change-password')}}">
                                            <span class="ti-key"></span>
                                            @lang('lang.password')
                                        </a>
                                    </li>
                                    <li>

                                        <a href="{{ Auth::user()->role_id == 2? route('student-logout'): route('logout')}}"
                                           onclick="event.preventDefault();

                                                     document.getElementById('logout-form').submit();">
                                            <span class="ti-unlock"></span>
                                            logout
                                        </a>

                                        <form id="logout-form"
                                              action="{{ Auth::user()->role_id == 2? route('student-logout'): route('logout') }}"
                                              method="POST" style="display: none;">

                                            @csrf
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


@section('script')

    <script>

        $('#languageChange').on('change', function () {
            var str = $('#languageChange').val();
            window.location.href = str;
        });

    </script>
@endsection
