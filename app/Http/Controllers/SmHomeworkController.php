<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\SmBaseSetup;
use DB;
use App\SmHomework;
use App\SmClass;
use App\SmSection;
use App\SmClassSection;
use App\SmAssignSubject;
use App\SmSubject;
use App\SmStudent;
use App\SmHomeworkStudent;
use App\SmNotification;
use Validator;

class SmHomeworkController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
    }


    public function homeworkList(Request $request)
    {
        $homeworkLists = SmHomework::all();
        $classes = SmClass::where('active_status', '=', '1')->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['homeworkLists'] = $homeworkLists->toArray();
            $data['classes'] = $classes->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }

        return view('backEnd.homework.homeworkList', compact('homeworkLists', 'classes'));
    }

    public function searchHomework(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'class_id' => "required"
        ]);

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $homeworkLists = SmHomework::query();
        $homeworkLists->where('active_status', 1);
        $homeworkLists->where('class_id', $request->class_id);


        if ($request->section_id != "") {
            $homeworkLists->where('section_id', $request->section_id);
        }
        if ($request->subject_id != "") {
            $homeworkLists->where('subject_id', $request->subject_id);
        }

        $homeworkLists = $homeworkLists->get();


        $classes = SmClass::where('active_status', '=', '1')->get();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            $data=[];
            $data['homeworkLists']= $homeworkLists->toArray();
            $data['classes']= $classes->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.homework.homeworkList', compact('homeworkLists', 'classes'));


    }

    public function addHomework()
    {
        $classes = SmClass::where('active_status', '=', '1')->get();
        return view('backEnd.homework.addHomework', compact('classes'));
    }

    public function saveHomeworkData(Request $request)
    {
        $request->validate([
            'class_id' => "required",
            'section_id' => "required",
            'subject_id' => "required",
            'homework_date' => "required",
            'submission_date' => "required",
            'marks' => "required",
            'description' => "required"
        ]);


        $fileName = "";
        if ($request->file('homework_file') != "") {
            $file = $request->file('homework_file');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/homework/', $fileName);
            $fileName = 'public/uploads/homework/' . $fileName;
        }

        $homeworks = new SmHomework();
        $homeworks->class_id = $request->class_id;
        $homeworks->section_id = $request->section_id;
        $homeworks->subject_id = $request->subject_id;
        $homeworks->homework_date = date('Y-m-d', strtotime($request->homework_date));
        $homeworks->submission_date = date('Y-m-d', strtotime($request->submission_date));
        $homeworks->marks = $request->marks;
        $homeworks->description = $request->description;
        $homeworks->file = $fileName;
        $homeworks->created_by = Auth()->user()->id;
        $results = $homeworks->save();


        $students = SmStudent::select('id')->where('class_id', $request->class_id)->where('section_id', $request->section_id)->get();
        foreach ($students as $student) {
            $notification = new SmNotification;
            $notification->user_id = $student->id;
            $notification->role_id = 2;
            $notification->date = date('Y-m-d');
            $notification->message = 'New online exam created';
            $notification->save();
        }


        if ($results) {
            return redirect('homework-list')->with('message-success', 'Homework has been created successfully');
        } else {
            return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
        }
    }

    public function ajaxSubjectDropdown(Request $request)
    {
        $class_id = $request->class;
        $allSubjects = SmAssignSubject::where([['section_id', '=', $request->id], ['class_id', $class_id]])->get();

        $subjectsName = [];
        foreach ($allSubjects as $allSubject) {
            $subjectsName[] = SmSubject::find($allSubject->subject_id);
        }

        return response()->json([$subjectsName]);
    }

    public function evaluationHomework(Request $request, $class_id, $section_id, $homework_id)
    {

        $homeworkDetails = SmHomework::where('class_id', '=', $class_id)->
        where('section_id', '=', $section_id)->where('id', '=', $homework_id)->first();


        $students = SmStudent::where('class_id', '=', $class_id)->where('section_id', '=', $section_id)->where('active_status', 1)->get();

        return view('backEnd.homework.evaluationHomework', compact('homeworkDetails', 'students', 'homework_id'));
    }

    public function saveHomeworkEvaluationData(Request $request)
    {


        if (!$request->student_id) {
            return redirect()->back()->with('message-success', 'Their are no students selected');
        } else {
            $student_idd = count($request->student_id);

            if ($student_idd > 0) {
                for ($i = 0; $i < $student_idd; $i++) {

                    SmHomeworkStudent::where('student_id', $request->student_id[$i])->where('homework_id', $request->homework_id)->delete();

                    $homeworkstudent = new SmHomeworkStudent();
                    $homeworkstudent->homework_id = $request->homework_id;
                    $homeworkstudent->student_id = $request->student_id[$i];
                    $homeworkstudent->marks = $request->marks[$i];
                    $homeworkstudent->teacher_comments = $request->teacher_comments[$request->student_id[$i]];
                    $homeworkstudent->complete_status = $request->homework_status[$request->student_id[$i]];
                    $homeworkstudent->created_by = Auth()->user()->id;
                    $results = $homeworkstudent->save();

                }

                $homeworks = SmHomework::find($request->homework_id);
                $homeworks->evaluation_date = date('Y-m-d', strtotime($request->evaluation_date));
                $homeworks->updated_by = Auth()->user()->id;
                $resultss = $homeworks->update();
            }

            if ($results) {
                return redirect()->back()->with('message-success', 'Homework Evaluation  has been updated successfully');
            }

        }
    }

    public function evaluationReport(Request $request)
    {
        $homeworkLists = SmHomework::all();
        $classes = SmClass::where('active_status', '=', '1')->get();
        return view('backEnd.reports.evaluation', compact('homeworkLists', 'classes'));
    }

    public function searchEvaluation(Request $request)
    {
        $request->validate([
            'subject_id' => "required"
        ]);

        $homeworkLists = SmHomework::where('active_status', '=', '1')->where('subject_id', '=', $request->subject_id)->get();
        $classes = SmClass::all();
        return view('backEnd.reports.evaluation', compact('homeworkLists', 'classes'));
    }

    public function viewEvaluationReport($homework_id)
    {

        $homeworkDetails = SmHomework::where('id', $homework_id)->first();
        $homework_students = SmHomeworkStudent::where('homework_id', $homework_id)->get();


        // foreach($students as $student){
        //   $allStudents[] = SmStudent::select('full_name', 'admission_no')->where('id', $student->student_id)->first();
        // }

        return view('backEnd.reports.viewEvaluationReport', compact('homeworkDetails', 'homework_students'));
    }

    public function homeworkEdit($id)
    {
        $homeworkList = SmHomework::find($id);
        $classes = SmClass::where('active_status', '=', '1')->get();
        $sections = SmClassSection::where('class_id', '=', $homeworkList->class_id)->get();


        $subjects = SmAssignSubject::where('class_id', $homeworkList->class_id)->where('section_id', $homeworkList->section_id)->get();


        return view('backEnd.homework.homeworkEdit', compact('homeworkList', 'classes', 'sections', 'subjects'));

    }

    public function homeworkUpdate(Request $request)
    {
        $request->validate([
            'class_id' => "required",
            'section_id' => "required",
            'subject_id' => "required",
            'homework_date' => "required",
            'submission_date' => "required",
            'marks' => "required",
            'description' => "required"
        ]);


        $fileName = "";
        if ($request->file('homework_file') != "") {
            $file = $request->file('homework_file');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/homework/', $fileName);
            $fileName = 'public/uploads/homework/' . $fileName;
        }

        $homeworks = SmHomework::find($request->id);
        $homeworks->class_id = $request->class_id;
        $homeworks->section_id = $request->section_id;
        $homeworks->subject_id = $request->subject_id;
        $homeworks->homework_date = date('Y-m-d', strtotime($request->homework_date));
        $homeworks->submission_date = date('Y-m-d', strtotime($request->submission_date));
        $homeworks->marks = $request->marks;
        $homeworks->description = $request->description;
        if ($fileName != "") {
            $homeworks->file = $fileName;
        }
        $results = $homeworks->save();

        if ($results) {
            return redirect('homework-list')->with('message-success', 'Homework has been updated successfully');
        } else {
            return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
        }
    }

    public function homeworkDelete($id)
    {
        $homework = SmHomework::find($id);
        if ($homework->file != "") {
            unlink($homework->file);
        }
        $result = $homework->delete();
        if ($result) {
            return redirect('homework-list')->with('message-success', 'Homework has been deleted successfully');
        } else {
            return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
        }
    }

}
