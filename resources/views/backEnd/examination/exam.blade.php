@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.exam')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.examinations')</a>
                <a href="#">@lang('lang.exam')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        @if(isset($exam))
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{url('exam')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    @lang('lang.add')
                </a>
            </div>
        </div>
        @endif

    @if(isset($exam))
    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'exam/'.$exam->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
    @else
    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'exam',
    'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
    @endif

        <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">@if(isset($exam))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.exam')
                            </h3>
                        </div>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                        @if(Session()->has('message-success'))
                                        <div class="alert alert-success">
                                            {{ Session()->get('message-success') }}
                                        </div>
                                        @elseif(Session()->has('message-danger'))
                                        <div class="alert alert-danger">
                                            {{ Session()->get('message-danger') }}
                                        </div>
                                        @endif
                                        <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                        
                                    </div>
                                </div>

                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                            <label>@lang('lang.select_class') *</label>
                                            @php $h = 0; @endphp
                                        @foreach($classes as $class)
                                            <div class="input-effect">
                                                <input type="checkbox" id="classes_{{$class->id}}" class="common-checkbox class-checkbox" name="class_ids[]" value="{{$class->id}}" {{ (is_array(old('class_ids')) and in_array($class->id, old('class_ids'))) ? ' checked' : '' }}>
                                                <label for="classes_{{$class->id}}">{{$class->class_name}}</label>
                                            </div>
                                            @php $h++; @endphp
                                        @endforeach

                                            <div class="input-effect">
                                            <input type="checkbox" id="all_classes" class="common-checkbox" name="all_classes[]" value="0" {{ (is_array(old('class_ids')) and in_array($class->id, old('class_ids'))) ? ' checked' : '' }}>
                                            <label for="all_classes">All Select</label>
                                        </div>


                                    </div>
                                    <div class="col-lg-12">

                                        @if($errors->has('class_ids'))
                                            <span class="text-danger validate-textarea-checkbox" role="alert">
                                                <strong>{{ $errors->first('class_ids') }}</strong>
                                            </span>
                                        @endif

                                    </div>
                                </div>




                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                            <label>@lang('lang.select_section') *</label>
                                        @foreach($sections as $section)
                                            <div class="input-effect">
                                                <input type="checkbox" id="sections_{{$section->id}}" class="common-checkbox section-checkbox" name="section_ids[]" value="{{$section->id}}">
                                                <label for="sections_{{$section->id}}">{{$section->section_name}}</label>
                                            </div>
                                        @endforeach


                                    <div class="input-effect">
                                        <input type="checkbox" id="all_sections" class="common-checkbox" name="all_sections[]" value="0" {{ (is_array(old('class_ids')) and in_array($class->id, old('class_ids'))) ? ' checked' : '' }}>
                                        <label for="all_sections">All Select</label>
                                    </div>

                                    </div>
                                    <div class="col-lg-12">

                                        @if($errors->has('section_ids'))
                                            <span class="text-danger validate-textarea-checkbox" role="alert">
                                                <strong>{{ $errors->first('section_ids') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>



                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                            <label>@lang('lang.select_subjects') *</label>
                                        @foreach($subjects as $subject)
                                            <div class="input-effect">
                                                <input type="checkbox" id="subjects_{{$subject->id}}" class="common-checkbox subject-checkbox" name="subjects_ids[]" value="{{$subject->id}}">
                                                <label for="subjects_{{$subject->id}}">{{$subject->subject_name}}</label>
                                            </div>
                                        @endforeach

                                    <div class="input-effect">
                                        <input type="checkbox" id="all_subjects" class="common-checkbox" name="all_subjects[]" value="0" {{ (is_array(old('class_ids')) and in_array($class->id, old('class_ids'))) ? ' checked' : '' }}>
                                        <label for="all_subjects">All Select</label>
                                    </div>


                                    </div>
                                    <div class="col-lg-12">

                                        @if($errors->has('subjects_ids'))
                                            <span class="text-danger validate-textarea-checkbox" role="alert">
                                                <strong>{{ $errors->first('subjects_ids') }}</strong>
                                            </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <label>@lang('lang.select') @lang('lang.exam_type') *</label>
                                
                                        @foreach($exams_types as $exams_type)
                                            <div class="input-effect">
                                                <input type="checkbox" id="exams_types_{{$exams_type->id}}" class="common-checkbox exam-checkbox" name="exams_types[]" value="{{$exams_type->id}}" {{isset($selected_exam_type_id)? ($exams_type->id == $selected_exam_type_id? 'checked':''):''}}>
                                                <label for="exams_types_{{$exams_type->id}}">{{$exams_type->title}}</label>
                                            </div>
                                        @endforeach
                                    <div class="input-effect">
                                        <input type="checkbox" id="all_exams" class="common-checkbox" name="all_exams[]" value="0" {{ (is_array(old('class_ids')) and in_array($class->id, old('class_ids'))) ? ' checked' : '' }}>
                                        <label for="all_exams">All Select</label>
                                    </div>

                                      
                                    </div>
                                    <div class="col-lg-12">

                                        @if($errors->has('exams_types'))
                                            <span class="text-danger validate-textarea-checkbox" role="alert">
                                                <strong>{{ $errors->first('exams_types') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div> 


                                <div class="row mt-25">
                                    <div class="col-lg-12">

                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('exam_marks') ? ' is-invalid' : '' }}"
                                            type="number" name="exam_marks" id="exam_mark_main" autocomplete="off" value="{{isset($exam)? $exam->exam_mark:''}}" required="">
                                            <label>@lang('lang.exam_mark') *</label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('exam_marks'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('exam_marks') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

  
                            </div>
                        </div>
                    </div>
                </div>

                <!-- //add mark distributions sections -->
                <!-- <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-30">@lang('lang.add_mark_distributions') </h3>
                        </div>
                    </div>
                    <div class="offset-lg-2 col-lg-6 text-right col-md-6">
                        <button type="button" class="primary-btn icon-only fix-gr-bg" onclick="addRowMark();" id="addRowBtn">
                        <span class="ti-plus pr-2"></span></button>
                    </div>
                </div> -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="white-box mt-10">
                            <div class="row">
                                 <div class="col-lg-10">
                                    <div class="main-title">
                                        <h5>@lang('lang.add_mark_distributions') </h5>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <button type="button" class="primary-btn icon-only fix-gr-bg" onclick="addRowMark();" id="addRowBtn">
                                    <span class="ti-plus pr-2"></span></button>
                                </div>
                            </div>


                            <table class="table" id="productTable">
                                <thead>
                                    <tr>
                                      <th>@lang('lang.exam_title')</th>
                                      <th>@lang('lang.exam_mark')</th>
                                      <th>@lang('lang.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <tr id="row1" class="mt-40">
                                    <td class="border-top-0">
                                        <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">  
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('exam_title') ? ' is-invalid' : '' }}"
                                                type="text" id="exam_title" name="exam_title[]" autocomplete="off" value="{{isset($editData)? $editData->exam_title : '' }}">
                                                <label>@lang('lang.ct_AT_Exam')</label>
                                        </div>
                                    </td>
                                    <td class="border-top-0">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('exam_mark') ? ' is-invalid' : '' }} exam_mark"
                                            type="text" id="exam_mark" name="exam_mark[]" autocomplete="off"   value="{{isset($editData)? $editData->exam_mark : 0 }}">
                                        </div>
                                    </td> 
                                    <td>
                                         <button class="primary-btn icon-only fix-gr-bg" type="button">
                                             <span class="ti-trash"></span>
                                        </button>
                                       
                                    </td>
                                    </tr>
                                    <tfoot>
                                        <tr>
                                           <td class="border-top-0">@lang('lang.total')</td>

                                           <td class="border-top-0" id="totalMark">
                                             <input type="text" class="primary-input form-control" name="totalMark" readonly="true">
                                           </td>
                                           <td class="border-top-0"></td>
                                       </tr>
                                   </tfoot>
                               </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row mt-40">
                    <div class="col-lg-12">
                        <div class="white-box">                               
                            <div class="row mt-40">
                                <div class="col-lg-12 text-center">
                                    <button class="primary-btn fix-gr-bg">
                                        <span class="ti-check"></span>
                                        @if(isset($exam))
                                            @lang('lang.update')
                                        @else
                                            @lang('lang.save')
                                        @endif
                                        @lang('lang.mark_distribution')

                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
            <div class="col-lg-9">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-0">@lang('lang.exam') @lang('lang.list')</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                    <thead>
                                @if(session()->has('message-success-delete') != "" ||
                                session()->get('message-danger-delete') != "")
                                <tr>
                                    <td colspan="7">
                                        @if(session()->has('message-success-delete'))
                                        <div class="alert alert-success">
                                            {{ session()->get('message-success-delete') }}
                                        </div>
                                        @elseif(session()->has('message-danger-delete'))
                                        <div class="alert alert-danger">
                                            {{ session()->get('message-danger-delete') }}
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <th>@lang('lang.exam_title')</th>
                                    <th>@lang('lang.class')</th>
                                    <th>@lang('lang.section')</th>
                                    <th>@lang('lang.subject')</th>
                                    <th>@lang('lang.total_mark')</th>
                                    <th>@lang('lang.mark_distribution')</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                    </thead>

                    <tbody>
                                @foreach($exams as $exam)
                                <tr>

                                    <td>{{$exam->GetExamTitle !=""?$exam->GetExamTitle->title:""}}</td>
                                    <td>{{$exam->getClassName !=""?$exam->getClassName->class_name:""}}</td>
                                    <td>{{$exam->GetSectionName !=""?$exam->GetSectionName->section_name:""}}</td>
                                    <td>{{$exam->GetSubjectName !=""?$exam->GetSubjectName->subject_name:""}}</td>
                                    <td>{{$exam->exam_mark}}</td>

                                   <td>
                                        @php $mark_distributions = App\SmExam::getMarkDistributions($exam->exam_type_id, $exam->class_id,  $exam->section_id, $exam->subject_id);  @endphp                                  
                                      

                                        @foreach($mark_distributions as $row)
                                        <div class="row">
                                           <div class="col-sm-6"> {{$row->exam_title}} </div> <div class="col-sm-4"><b> {{$row->exam_mark}} </b></div> 
                                       </div>
                                        @endforeach
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
{{--                                                <a class="dropdown-item" href="{{url('exam', [$exam->id--}}
{{--                                                    ])}}">@lang('lang.edit')</a>--}}
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteExamModal{{$exam->id}}"
                                                    href="#">@lang('lang.delete')</a>
{{--                                                <a class="dropdown-item" href="{{route('view_exam_status', [$exam->id])}}">@lang('lang.view_status')</a>--}}
                                            </div>
                                        </div> 
{{--                                            <a href="{{url('/')}}/exam-copy/{{$exam->id}}" class="mt-10 primary-btn small tr-bg"> <span class="ti-layers-alt"> </span> @lang('lang.copy') </a>--}}

                                    </td>
                                </tr>
                                    <div class="modal fade admin-query" id="deleteExamModal{{$exam->id}}" >
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">@lang('lang.delete') @lang('lang.exam')</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                    </div>

                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                         {{ Form::open(['url' => 'exam/'.$exam->id, 'method' => 'DELETE', 'enctype' => 'multipart/form-data']) }}
                                                        <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                                                         {{ Form::close() }}
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>


    </div>
</section>
@endsection
