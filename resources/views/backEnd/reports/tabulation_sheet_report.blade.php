@extends('backEnd.master')
@section('mainContent')
<style type="text/css">

  td{
        text-align: center !important;
        border-right: 1px solid #a2a7c5;
    border-left: 1px solid #a2a7c5;
    }
    tr,th,tr{
        border: 1px solid #a2a6c5;
        text-align: center;
    }
</style>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.tabulation_sheet_report') </h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.reports')</a>
                <a href="{{route('tabulation_sheet_report')}}">@lang('lang.tabulation_sheet_report')</a>
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
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'tabulation_sheet_report', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                        <div class="row">
                            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                            <div class="col-lg-3 mt-30-md">
                                <select class="w-100 bb niceSelect form-control{{ $errors->has('exam') ? ' is-invalid' : '' }}" name="exam">
                                    <option data-display="@lang('lang.select_exam')*" value="">@lang('lang.select_exam') *</option>
                                    @foreach($exam_types as $exam)
                                        <option value="{{$exam->id}}" {{isset($exam_id)? ($exam_id == $exam->id? 'selected':''):''}}>{{$exam->title}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('exam'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('exam') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-lg-3 mt-30-md">
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
                            <div class="col-lg-3 mt-30-md" id="select_section_div">
                                <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }} select_section" id="select_section" name="section">
                                    <option data-display="Select section *" value="">Select section *</option>
                                </select>
                                @if ($errors->has('section'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('section') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-lg-3 mt-30-md" id="select_student_div">
                                <select class="w-100 bb niceSelect form-control{{ $errors->has('student') ? ' is-invalid' : '' }}" id="select_student" name="student">
                                    <option data-display="@lang('lang.select_student')" value="">@lang('lang.select_student')</option>
                                </select>
                                @if ($errors->has('student'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('student') }}</strong>
                                </span>
                                @endif
                            </div>

                            
                            <div class="col-lg-12 mt-20 text-right">
                                <button type="submit" class="primary-btn small fix-gr-bg">
                                    <span class="ti-search"></span>
                                    @lang('lang.search')
                                </button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
</section>

@if(isset($marks))
<section class="student-details">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-30 mt-30"> @lang('lang.student_terminal_report')</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="single-report-admit">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-lg-4">
                                <img class="logo-img" src="http://localhost/laravel/schoolmanagementsystem/public/backEnd/img/logo.png" alt="">
                            </div>
                            <div class="col-lg-4 text-left text-lg-center mt-30-md">
                                <h4 class="text-white">@lang('lang.class'): 01</h4>
                                <h4 class="text-white mb-0">@lang('lang.section'): A</h4>
                            </div>
                            <div class="offset-lg-1 col-lg-3 text-left text-lg-right mt-30-md">
                                <h3 class="text-white">@lang('lang.school_management_system')</h3>
                                <p class="text-white mb-0">@lang('lang.united_states_of_america')</p>
                            </div>
                        </div>
                    </div>

                    <div class="white-box">
                        <table class="w-100 mt-30 mb-20">
                            <thead>
                                <tr>
                                    <th rowspan="2">@lang('lang.student') @lang('lang.name')</th>
                                    <th rowspan="2">@lang('lang.admission') @lang('lang.no')</th>
                                    @foreach($subjects as $subject)
                                        @php 
                                            $subject_ID     = $subject->subject_id; 
                                            $subject_Name   = $subject->subject->subject_name;
                                            $mark_parts      = App\SmAssignSubject::getNumberOfPart($subject_ID, $class_id, $section_id, $exam_term_id);  
                                        @endphp
                                        <th colspan="{{count($mark_parts)+1}}" class="text-center" style="border-right: 1px solid #ddd; border-left: 1px solid #rrf"> {{$subject_Name}}</th>
                                    @endforeach
                                    <th rowspan="2">@lang('lang.total_mark')</th>
                                    <th rowspan="2">@lang('lang.gpa')</th>
                                    <th rowspan="2">@lang('lang.gpa') @lang('lang.grade')</th>
                                </tr>
                                <tr>

                                    @foreach($subjects as $subject)
                                        @php 
                                            $subject_ID     = $subject->subject_id; 
                                            $subject_Name   = $subject->subject->subject_name;
                                            $mark_parts     = App\SmAssignSubject::getNumberOfPart($subject_ID, $class_id, $section_id, $exam_term_id);  
                                        @endphp

                                        @foreach($mark_parts as $sigle_part)
                                            <th style="text-align: center;" class="total">{{$sigle_part->exam_title}}</th>
                                        @endforeach
                                        <th class="total">@lang('lang.total')</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                <tr>
                                    <td> {{$student->full_name}}</td>
                                    <td> {{$student->admission_no}}</td>

                                    @foreach($subjects as $subject)
                                        @php 
                                            $subject_ID     = $subject->subject_id; 
                                            $subject_Name   = $subject->subject->subject_name;
                                            $mark_parts     = App\SmAssignSubject::getMarksOfPart($student->id, $subject_ID, $class_id, $section_id, $exam_term_id);  
                                        @endphp
                                        @foreach($mark_parts as $sigle_part)
                                            <td class="total">{{$sigle_part->total_marks}}</td>
                                        @endforeach
                                        <td class="total">
                                            {{App\SmAssignSubject::getSumMark($student->id, $subject_ID, $class_id, $section_id, $exam_term_id)}}
                                        </td>

                                    @endforeach
                                    <td>89</td>
                                    <td>5.00</td>
                                    <td>A+</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
            

@endsection
