<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use App\SmExamType;
use App\SmClass;
use App\SmMarkStore;
use App\SmAssignSubject;
use App\SmStudent;
use App\SmExam;
use App\SmResultStore;
use App\SmExamSetup;
use Validator;

class SmReportController extends Controller
{
    public function __construct(){
        $this->middleware('PM');
    }

    public function tabulationSheetReport(Request $request){
    	$exam_types = SmExamType::where('active_status', 1)->get();
    	$classes = SmClass::where('active_status', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['exam_types'] = $exam_types->toArray();
            $data['classes'] = $classes->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
    	return view('backEnd.reports.tabulation_sheet_report', compact('exam_types', 'classes'));
    }

    public function tabulationSheetReportSearch(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
    		'exam' => 'required',
    		'class' => 'required',
    		'section' => 'required'
    	]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $exam_term_id   = $request->exam;
        $class_id       = $request->class;
        $section_id     = $request->section;
        $student_id     = $request->student;

        if(isset($request->student)){
            $marks      = SmMarkStore::where([
                            ['exam_term_id', $request->exam],
                            ['class_id', $request->class],
                            ['section_id', $request->section],
                            ['student_id', $request->student]
                        ])->get();
            $students   = SmStudent::where([
                                ['class_id', $request->class],
                                ['section_id', $request->section],
                                ['id', $request->student]
                        ])->get();
        }else{            
            $marks = SmMarkStore::where([
                        ['exam_term_id', $request->exam],
                        ['class_id', $request->class],
                        ['section_id', $request->section]
                    ])->get();
        $students       = SmStudent::where([
                                ['class_id', $request->class],
                                ['section_id', $request->section]
                        ])->get();
        }


        $exam_types     = SmExamType::where('active_status', 1)->get();
        $classes        = SmClass::where('active_status', 1)->get();
        $subjects       = SmAssignSubject::where([
                            ['class_id', $request->class],
                            ['section_id', $request->section]
                        ])->get();



        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['exam_types'] = $exam_types->toArray();
            $data['classes'] = $classes->toArray();
            $data['marks'] = $marks->toArray();
            $data['subjects'] = $subjects->toArray();
            $data['exam_term_id'] = $exam_term_id;
            $data['class_id'] = $class_id;
            $data['section_id'] = $section_id;
            $data['students'] = $students->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }


        return view('backEnd.reports.tabulation_sheet_report', compact('exam_types', 'classes','marks','subjects', 'exam_term_id','class_id','section_id','students'));

    	
    }


    public function progressCardReport(Request $request){
        $exams = SmExam::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['routes'] = $exams->toArray();
            $data['assign_vehicles'] = $classes->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.reports.progress_card_report', compact('exams', 'classes'));
    }


    //student progress report search by rashed
    public function progressCardReportSearch(Request $request){

        //input validations, 3 input must be required
        $input = $request->all();
        $validator = Validator::make($input, [
            'class' => 'required',
            'section' => 'required',
            'student' => 'required'
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $exams = SmExam::where('active_status', 1)->get();
        $exam_types = SmExamType::where('active_status', 1)->get();
        $classes = SmClass::where('active_status', 1)->get();
        $studentDetails = SmStudent::find($request->student);
 

        $exam_setup = SmExamSetup::where([['class_id', $request->class],['section_id', $request->section]])->get();

        $class_id=$request->class;
        $section_id=$request->section;
        $student_id=$request->student;
  

        $subjects = SmAssignSubject::where([['class_id', $request->class],['section_id', $request->section]])->get();

        
        $is_result_available = SmResultStore::where([['class_id', $request->class],['section_id', $request->section],['student_id', $request->student]])->get();

        if($is_result_available->count()>0){

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                $data = [];
                $data['exams'] = $exams->toArray();
                $data['classes'] = $classes->toArray();
                $data['studentDetails'] = $studentDetails;
                $data['is_result_available'] = $is_result_available;
                $data['subjects'] = $subjects->toArray();
                $data['class_id'] = $class_id;
                $data['section_id'] = $section_id;
                $data['student_id'] = $student_id;
                $data['exam_types'] = $exam_types;
                return ApiBaseMethod::sendResponse($data, null);
            }
            return view('backEnd.reports.progress_card_report', compact('exams', 'classes','studentDetails','is_result_available','subjects','class_id','section_id','student_id','exam_types'));
        }else{
            return redirect('progress-card-report')->with('message-danger', 'Ops! Your result is not found! Please check mark register.');
        }
    }


}
