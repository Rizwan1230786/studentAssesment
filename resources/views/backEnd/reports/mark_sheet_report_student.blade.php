@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.mark_sheet_report') @lang('lang.student') </h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.reports')</a>
                <a href="#">@lang('lang.mark_sheet_report') @lang('lang.student')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">@lang('lang.select_criteria')</h3>
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
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'mark_sheet_report_student', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                        <div class="row">
                            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                            <div class="col-lg-3 mt-30-md">
                                <select class="w-100 bb niceSelect form-control{{ $errors->has('exam') ? ' is-invalid' : '' }}" name="exam">
                                    <option data-display="@lang('lang.select_exam') *" value="">@lang('lang.select_exam') *</option>
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
                                    <option data-display="@lang('lang.select_student') *" value="">@lang('lang.select_student') *</option>
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


@if(isset($is_result_available))
@php 
    $generalSetting= App\SmGeneralSettings::find(1);
    if(!empty($generalSetting)){
        $school_name =$generalSetting->school_name;
        $site_title =$generalSetting->site_title;
        $school_code =$generalSetting->school_code;
        $address =$generalSetting->address;
        $phone =$generalSetting->phone; 
    }

@endphp
<section class="student-details">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-30 mt-30">@lang('lang.mark_sheet_report')</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="single-report-admit">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex">
                                            <div>
                                                <img class="logo-img" src="http://localhost/laravel/schoolmanagementsystem/public/backEnd/img/logo.png" alt="">
                                            </div>
                                            <div class="ml-30">
                                                <h3 class="text-white"> {{isset($school_name)?$school_name:'Infix School Management ERP'}} </h3>
                                                <p class="text-white mb-0"> {{isset($address)?$address:'Infix School Adress'}} </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <h3>Student Info</h3>
                                                    <div class="row">
                                                            <div class="col-lg-7">
                                                                <p class="mb-0">
                                                                    @lang('lang.name') : <span class="primary-color fw-500">{{$student_detail->full_name}}</span>
                                                                </p>
                                                                <p class="mb-0">
                                                                    @lang('lang.father_name') : <span class="primary-color fw-500">{{$student_detail->parents->fathers_name}}</span>
                                                                </p>
                                                                <p class="mb-0">
                                                                    @lang('lang.admission') @lang('lang.no'): <span class="primary-color fw-500">{{$student_detail->admission_no}}</span>
                                                                </p>
                                                                <p class="mb-0">
                                                                    @lang('lang.class') : <span class="primary-color fw-500">{{$class_name->class_name}}</span>
                                                                </p>
                                                                <p class="mb-0">
                                                                  {{--   @lang('lang.section') : <span class="primary-color fw-500">{{$section->section_name}}</span> --}}
                                                                </p>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <h3>Exam info</h3>
                                                    <div class="row">
                                                        <div class="col-lg-5">
                                                           
                                                            <p class="mb-0">
                                                              @lang('lang.exam') : <span class="primary-color fw-500">{{$exam_details->title}}</span> 
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>



                                        <table class="w-100 mt-30 mb-20">
                                            <thead>
                                            <tr>
                                                <th rowspan="2">@lang('lang.subjects')</th> 
                                                    <th colspan="7"  class="text-center">{{$exam_details->title}}</th> 
                                                    <th rowspan="2" class="text-center">Avg. GPA </th>
                                                    <th rowspan="2" class="text-center">Avg Grade</th>
                                                    <th rowspan="2" class="text-center">Position</th>

                                            </tr>
                                            <tr  class="text-center"> 
                                                    <th>Ex</th>
                                                    <th>AT</th>
                                                    <th>CT</th>
                                                    <th>AS</th>
                                                    <th>Total</th>
                                                    <th>Grade</th> 
                                                    <th>Grade Point</th> 
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php $sum_gpa= 0;  $resultCount=1; @endphp
                                            @foreach($subjects as $data)
                                                <tr  class="text-center">
                                                    <td style="text-align: left;">{{$data->subject->subject_name}}</td>
                                                    <?php
                                                    $TotalSum=[]; 
                                                    $mark_parts     =   App\SmAssignSubject::getNumberOfPart($data->subject_id, $class_id, $section_id, $exam_type_id);
                                                    $result         =   App\SmResultStore::GetResultBySubjectId($class_id, $section_id, $data->subject_id,$exam_type_id ,$student_id);
                                                    if(!empty($result)){
                                                        $final_results         =   App\SmResultStore::GetFinalResultBySubjectId($class_id, $section_id, $data->subject_id,$exam_type_id ,$student_id);
                                                    }
                                                    if(!empty($final_results)){
                                                        $TotalGPA = empty($final_results->total_gpa_point)?0:$final_results->total_gpa_point;
                                                    }else{
                                                        $TotalGPA =0;
                                                    }
                                                    $sum_gpa = $sum_gpa + $TotalGPA;

                                                    if($result->count()>0){
                                                        foreach($result as $r){
                                                            if(!isset($TotalSum[$data->subject_id])){ $TotalSum[$data->subject_id]=0; }
                                                            $TotalSum[$data->subject_id] = $TotalSum[$data->subject_id] + $r->total_marks; 
                                                    ?>
                                                            <td>{{!empty($r->total_marks)?$r->total_marks:'0'}}</td>
                                                        <?php }  ?>
                                                            <td>{{ !empty($final_results)? $final_results->total_marks:0}}</td>
                                                            <td>{{ !empty($final_results)? $final_results->total_gpa_grade:'-'}}</td>
                                                            <td>{{ !empty($final_results)? $final_results->total_gpa_point:'-'}}</td>
                                                    <?php }  

                                                            if($resultCount==$subjects->count()){ 
                                                                if(!empty($sum_gpa)){ $average_gpa = floor($sum_gpa/$subjects->count()); }else{ $average_gpa = 0.00; }
                                                                $markGrades=App\SmMarksGrade::where([['from','<=',$average_gpa],['up','>=',$average_gpa]])->first(); 
                                                                $positions = App\SmTemporaryMeritlist::where([ 
                                                                    ['class_id',$class_id], ['section_id',$section_id], ['exam_id',$exam_type_id], ['admission_no',$student_detail->admission_no]])->first();
                                                                if(!empty($positions)){ $position=$positions->merit_order; }else{ $position='-'; }
                                                                ?>
                                                                <td rowspan="{{$subjects->count()}}">{{ !empty($average_gpa)? $average_gpa :'0.00'}}</td>
                                                                <td rowspan="{{$subjects->count()}}"> <button class="primary-btn small bg-success text-white border-0">{{ !empty($markGrades)? $markGrades->grade_name :'F'}} </button> </td>
                                                                <td rowspan="{{$subjects->count()}}">{{ isset($position)? $position :'-'}}</td>
                                                            <?php } $resultCount=$resultCount+1;  ?>
                                                </tr>
 
                                                    

                                            @endforeach
                                            </tbody>
                                        </table>




{{--


                                        <table class="w-100 mt-30 mb-20">
                                            <thead>
                                                <tr>
                                                    <th> @lang('lang.subject')</th>
                                                    <th> @lang('lang.total_mark')</th>
                                                    <th> @lang('lang.top_obtained_mark')</th>
                                                    <th> @lang('lang.obtained_marks')</th>
                                                    <th> @lang('lang.grade')</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @php
                                                    $results = $marks_register->marksRegisterChilds;
                                                     $grand_total = 0;
                                                    $grand_total_marks = 0;
                                                    $grand_result = 0;
                                                @endphp
                                                @foreach($results as $result)
                                                <tr>
                                                    <td>{{$result->subject->subject_name}}</td>
                                                    <td>@php

                                                        $highest_mark = App\SmMarksRegister::highestMark($marks_register->exam_id, $result->subject_id, $student_detail->section_id, $student_detail->class_id);

                                                            //$subjectDetails = App\SmMarksRegister::subjectDetails($marks_register->exam_id, $marks_register->class_id, $marks_register->section_id, $result->subject_id);
                                                            //echo $subjectDetails->full_mark;

                                                            $result_subject = 0;
                                                            $grand_total_marks += $subjectDetails->full_mark;
                                                        @endphp
                                                    </td>
                                                    
                                                    <td>{{$highest_mark}}</td>
                                                    <td>{{$result->abs == 0? $result->marks: 'ABS'}} </td>
                                                    
                                                    <td>
                                                        @php
                                                            if($result->abs == 0){
                                                                $grand_total += $result->marks;
                                                                if($result->marks < $subjectDetails->pass_mark){
                                                                   echo 'F';
                                                                   $result_subject++;
                                                                    $grand_result++;
                                                                }
                                                                else{
                                                                
                                                                    $percent = $result->marks/$subjectDetails->full_mark*100;
                                                                    foreach($grades as $grade){
                                                                       if(floor($percent) >= $grade->percent_from && floor($percent) <= $grade->percent_upto){
                                                                           echo $grade->grade_name;
                                                                       }
                                                                   }
                                                               }
                                                            }else{
                                                                $result_subject++;
                                                                $grand_result++;
                                                                echo 'F';
                                                            }
                                                            
                                                        @endphp
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            @if(count($results) != "")
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th>@lang('lang.grand_total'): {{$grand_total}}/{{$grand_total_marks}}</th>
                                                    <th></th>
                                                    <th>@lang('lang.grade'):
                                                        @php
                                                            if($grand_result == 0){
                                                                $percent = $grand_total/$grand_total_marks*100;
                                                              
                                                                
                                                                foreach($grades as $grade){
                                                                   if(floor($percent) >= $grade->percent_from && floor($percent) <= $grade->percent_upto){
                                                                       echo $grade->grade_name;
                                                                   }
                                                               }
                                                            }else{
                                                                echo "F";
                                                            }
                                                        @endphp
                                                    </th>
                                                </tr>
                                            </tfoot>
                                            @endif

                                        </table>
                                        --}}
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
