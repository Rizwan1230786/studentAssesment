@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.merit_list_report') </h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.reports')</a>
                <a href="#">@lang('lang.merit_list_report')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">@lang('lang.select_criteria') </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @if(session()->has('message-success') != "")
                    @if(session()->has('message-success'))
                    <div class="alert alert-success">
                        {{ session()->get('message-success') }}
                    </div>
                    @endif
                @endif
                 @if(session()->has('message-danger') != "")
                    @if(session()->has('message-danger'))
                    <div class="alert alert-danger">
                        {{ session()->get('message-danger') }}
                    </div>
                    @endif
                @endif
                <div class="white-box">
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'merit_list_report', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                        <div class="row">
                            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                            <div class="col-lg-4 mt-30-md">
                                <select class="w-100 bb niceSelect form-control{{ $errors->has('exam') ? ' is-invalid' : '' }}" name="exam">
                                    <option data-display="@lang('lang.select_exam')*" value="">@lang('lang.select_exam') *</option>
                                    @foreach($exams as $exam)
                                        <option value="{{$exam->id}}" {{isset($exam_id)? ($exam_id == $exam->id? 'selected':''):''}}>{{$exam->title}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('exam'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('exam') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-lg-4 mt-30-md">
                                <select class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="class">
                                    <option data-display="@lang('lang.select_class') *" value="">@lang('lang.select_class') *</option>
                                    @foreach($classes as $class)
                                    <option value="{{$class->id}}" {{isset($class_id)? ($class_id == $class->id? 'selected':''):''}}>{{$class->class_name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('class'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('class') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-lg-4 mt-30-md" id="select_section_div">
                                <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }} select_section" id="select_section" name="section">
                                    <option data-display="@lang('lang.select_section')*" value="">@lang('lang.select_section') *</option>
                                </select>
                                @if ($errors->has('section'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('section') }}</strong>
                                </span>
                                @endif
                            </div>
                            
                            <div class="col-lg-12 mt-20 text-right">
                                <button type="submit" class="primary-btn small fix-gr-bg">
                                    <span class="ti-search pr-2"></span>
                                    @lang('lang.search')
                                </button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
</section>


@if(isset($allresult_data))
<section class="student-details">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-30 mt-30">@lang('lang.merit_list_report')</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                    <div class="row justify-content-center">
                        <div class="col-lg-11">
                            <div class="single-report-admit">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex">
                                            <div>
                                                <img class="logo-img" src="http://localhost/naim/schoolmanagementsystem/public/backEnd/img/logo.png" alt="">
                                            </div>
                                            <div class="ml-30">
                                                <h3 class="text-white">@lang('lang.school_management_system')</h3>
                                                <p class="text-white mb-0">@lang('lang.united_states_of_america')</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h3>@lang('lang.order_of_merit_list')</h3>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <p class="mb-0">
                                                                @lang('lang.academic_year') : <span class="primary-color fw-500">2018-19</span>
                                                            </p>
                                                            <p class="mb-0">
                                                                @lang('lang.exam') : <span class="primary-color fw-500">{{$exam_name}}</span>
                                                            </p>
                                                            <p class="mb-0">
                                                                @lang('lang.class') : <span class="primary-color fw-500">{{$class_name}}</span>
                                                            </p>
                                                            <p class="mb-0">
                                                                @lang('lang.section') : <span class="primary-color fw-500">{{$section->section_name}}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <h3>@lang('lang.subjects')</h3>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            @foreach($assign_subjects as $subject)
                                                            <p class="mb-0">
                                                                <span class="primary-color fw-500">{{$subject->subject->subject_name}}</span>
                                                            </p>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <table class="w-100 mt-30 mb-20">
                                            <thead>
                                                <tr>
                                                    <th>@lang('lang.student')</th>
                                                    <th>@lang('lang.position')</th>
                                                    <th>@lang('lang.admission') @lang('lang.no')</th>
                                                    @foreach($subjectlist as $subject)
                                                    <th>{{$subject}}</th>
                                                    @endforeach

                                                    <th>@lang('lang.total_mark')</th>
                                                    <th>@lang('lang.average')</th>
                                                    <th>@lang('lang.gpa')</th>
                                                    <th>@lang('lang.result')</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @php $i=1; @endphp
                                                @foreach($allresult_data as $row)

                                               

                                                <tr>
                                                    <td>{{$row->student_name}}</td>
                                                    <td>{{$row->merit_order}}</td>
                                                    <td>{{$row->admission_no}}</td>
                                                    @php $markslist = explode(',',$row->marks_string);   @endphp  
                                                    @foreach($markslist as $mark)
                                                        <td>{{$mark}}</td>
                                                    @endforeach


                                                    <td>{{$row->total_marks}}</td>
                                                    <td>{{$row->average_mark}} </td>
                                                    <td>{{$row->gpa_point}} </td> 
                                                    <td> 
                                                        <button class="primary-btn small bg-success text-white border-0">{{$row->result}}</button>
                                                    </td>
                                                </tr> 

                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endif
            

@endsection
