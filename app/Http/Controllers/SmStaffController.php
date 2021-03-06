<?php

namespace App\Http\Controllers;

use App\ApiBaseMethod;
use Illuminate\Http\Request;
use App\SmStaff;
use Illuminate\Support\Facades\Hash;
use App\SmBaseSetup;
use App\User;
use App\Role;
use App\SmHumanDepartment;
use App\SmDesignation;
use App\SmHrPayrollGenerate;
use App\SmLeaveRequest;
use DB;
use App\SmStudentDocument;
use App\SmStudentTimeline;
use Validator;
class SmStaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
    }

    public function staffList(Request $request)
    {
        $staffs = SmStaff::where('active_status', 1)->get();
        $roles = Role::where('active_status', '=', '1')->where('id', '!=', 2)->where('id', '!=', 3)->get();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            $data=[];
            $data['staffs']= $staffs->toArray();
            $data['roles']= $roles->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.humanResource.staff_list', compact('staffs', 'roles'));
    }

    public function addStaff()
    {
        $max_staff_no = SmStaff::max('staff_no');
        $roles = Role::where('active_status', '=', '1')->where('id', '!=', 1)->where('id', '!=', 2)->where('id', '!=', 3)->orderBy('name', 'asc')->get();
        $departments = SmHumanDepartment::where('active_status', '=', '1')->get();
        $designations = SmDesignation::where('active_status', '=', '1')->orderBy('title', 'asc')->get();
        $marital_ststus = SmBaseSetup::where('active_status', '=', '1')->where('base_group_id', '=', '4')->get();

        $genders = SmBaseSetup::where('active_status', '=', '1')->where('base_group_id', '=', '1')->get();

        return view('backEnd.humanResource.addStaff', compact('roles', 'departments', 'designations', 'marital_ststus', 'max_staff_no', 'genders'));


    }

    public function staffStore(Request $request)
    {

        $request->validate([
            'staff_no' => "required",
            'role_id' => "required",
            'department_id' => "required",
            'designation_id' => "required",
            'first_name' => "required",
            'last_name' => "required",
            'email' => "required",
            'date_of_joining' => "required",
            'mobile' => "required",
            'current_address' => "required",
            'staff_photo' => "required",
            'gender_id' => "required",
            'basic_salary' => "required",

        ]);


        DB::beginTransaction();
        try {
            $user = new User();
            $user->role_id = $request->role_id;
            $user->username = $request->email;
            $user->email = $request->email;
            $user->full_name = $request->first_name . ' ' . $request->last_name;
            $user->password = Hash::make(123456);
            $user->save();
            $user->toArray();

            // for upload staff photo
            $staff_photo = "";
            if ($request->file('staff_photo') != "") {
                $file = $request->file('staff_photo');
                $staff_photo = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/staff/', $staff_photo);
                $staff_photo = 'public/uploads/staff/' . $staff_photo;
            }

            // for upload resume
            $resume = "";
            if ($request->file('resume') != "") {
                $file = $request->file('resume');
                $resume = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/resume/', $resume);
                $resume = 'public/uploads/resume/' . $resume;
            }

            // for upload Staff Joining Letter
            $joining_letter = "";
            if ($request->file('joining_letter') != "") {
                $file = $request->file('joining_letter');
                $joining_letter = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/staff_joining_letter/', $joining_letter);
                $joining_letter = 'public/uploads/staff_joining_letter/' . $joining_letter;
            }

            // for upload Staff Other Documents
            $other_document = "";
            if ($request->file('other_document') != "") {
                $file = $request->file('other_document');
                $other_document = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/others_documents/', $other_document);
                $other_document = 'public/uploads/others_documents/' . $other_document;
            }

            $basic_salary = '';
            if (!empty($request->basic_salary)) {
                $basic_salary = $request->basic_salary;
            } else {
                $basic_salary = 0;
            }

            $staff = new SmStaff();
            $staff->staff_no = $request->staff_no;
            $staff->role_id = $request->role_id;
            $staff->department_id = $request->department_id;
            $staff->designation_id = $request->designation_id;
            $staff->first_name = $request->first_name;
            $staff->last_name = $request->last_name;
            $staff->full_name = $request->first_name . ' ' . $request->last_name;
            $staff->fathers_name = $request->fathers_name;
            $staff->mothers_name = $request->mothers_name;
            $staff->email = $request->email;
            $staff->staff_photo = $staff_photo;
            $staff->gender_id = $request->gender_id;
            $staff->marital_status = $request->marital_status;
            $staff->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
            $staff->date_of_joining = date('Y-m-d', strtotime($request->date_of_joining));
            $staff->mobile = $request->mobile;
            $staff->emergency_mobile = $request->emergency_mobile;
            $staff->current_address = $request->current_address;
            $staff->permanent_address = $request->permanent_address;
            $staff->qualification = $request->qualification;
            $staff->experience = $request->experience;
            $staff->epf_no = $request->epf_no;
            $staff->basic_salary = $basic_salary;
            $staff->contract_type = $request->contract_type;
            $staff->location = $request->location;
            $staff->bank_account_name = $request->bank_account_name;
            $staff->bank_account_no = $request->bank_account_no;
            $staff->bank_name = $request->bank_name;
            $staff->bank_brach = $request->bank_brach;
            $staff->facebook_url = $request->facebook_url;
            $staff->twiteer_url = $request->twiteer_url;
            $staff->linkedin_url = $request->linkedin_url;
            $staff->instragram_url = $request->instragram_url;
            $staff->school_id = 1;
            $staff->user_id = $user->id;
            $staff->resume = $resume;
            $staff->joining_letter = $joining_letter;
            $staff->other_document = $other_document;
            $staff->driving_license = $request->driving_license;

            $results = $staff->save();
            DB::commit();
            return redirect()->back()->with('message-success', 'New Staff has been created successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
        }

        if ($results) {
            return redirect()->back()->with('message-success', 'New Staff has been created successfully');
        } else {
            return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
        }
    }

    public function editStaff($id)
    {
        $editData = SmStaff::find($id);
        $max_staff_no = SmStaff::max('staff_no');
        $roles = Role::where('active_status', '=', '1')->get();
        $departments = SmHumanDepartment::where('active_status', '=', '1')->get();
        $designations = SmDesignation::where('active_status', '=', '1')->get();
        $marital_ststus = SmBaseSetup::where('active_status', '=', '1')->where('base_group_id', '=', '4')->get();

        $genders = SmBaseSetup::where('active_status', '=', '1')->where('base_group_id', '=', '1')->get();

        return view('backEnd.humanResource.editStaff', compact('editData', 'roles', 'departments', 'designations', 'marital_ststus', 'max_staff_no', 'genders'));
    }

    public function staffUpdate(Request $request)
    {
        $request->validate([
            'staff_no' => "required",
            'role_id' => "required",
            'department_id' => "required",
            'designation_id' => "required",
            'first_name' => "required",
            'email' => "required",
            'date_of_joining' => "required",
            'mobile' => "required",
            'gender_id' => "required",

        ]);

        // for update staff photo
        $staff_photos = "";
        if ($request->file('staff_photo') != "") {
            $photos = SmStaff::find($request->staff_id);
            if ($photos->staff_photo != '') {
                unlink($photos->staff_photo);
            }
            $file = $request->file('staff_photo');
            $staff_photos = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/staff/', $staff_photos);
            $staff_photo = 'public/uploads/staff/' . $staff_photos;
        } else {
            $photos = SmStaff::find($request->staff_id);
            $staff_photo = $photos->staff_photo;
        }

        // for update resume
        $resume = "";
        if ($request->file('resume') != "") {
            $resumeExistFile = SmStaff::find($request->staff_id);
            if ($resumeExistFile->resume != '') {
                unlink($resumeExistFile->resume);
            }
            $file = $request->file('resume');
            $resume = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/resume/', $resume);
            $resume = 'public/uploads/resume/' . $resume;
        } else {
            $resumeExistFile = SmStaff::find($request->staff_id);
            $resume = $resumeExistFile->resume;
        }

        // for update Staff Joining Letter
        $joining_letter = "";
        if ($request->file('joining_letter') != "") {
            $joiningLetterExistFile = SmStaff::find($request->staff_id);
            if ($joiningLetterExistFile->joining_letter != '') {
                unlink($joiningLetterExistFile->joining_letter);
            }
            $file = $request->file('joining_letter');
            $joining_letter = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/staff_joining_letter/', $joining_letter);
            $joining_letter = 'public/uploads/staff_joining_letter/' . $joining_letter;
        } else {
            $joiningLetterExistFile = SmStaff::find($request->staff_id);
            $joining_letter = $joiningLetterExistFile->joining_letter;
        }

        // for update Staff Other Documents
        $other_document = "";
        if ($request->file('other_document') != "") {
            $otherDocumentExistFile = SmStaff::find($request->staff_id);
            if ($otherDocumentExistFile->other_document != '') {
                unlink($otherDocumentExistFile->other_document);
            }
            $file = $request->file('other_document');
            $other_document = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/others_documents/', $other_document);
            $other_document = 'public/uploads/others_documents/' . $other_document;
        } else {
            $otherDocumentExistFile = SmStaff::find($request->staff_id);
            $other_document = $otherDocumentExistFile->other_document;
        }

        $basic_salary = '';
        if (!empty($request->basic_salary)) {
            $basic_salary = $request->basic_salary;
        } else {
            $basic_salary = 0;
        }

        $staff = SmStaff::find($request->staff_id);
        $staff->staff_no = $request->staff_no;
        $staff->role_id = $request->role_id;
        $staff->department_id = $request->department_id;
        $staff->designation_id = $request->designation_id;
        $staff->first_name = $request->first_name;
        $staff->last_name = $request->last_name;
        $staff->full_name = $request->first_name . ' ' . $request->last_name;
        $staff->fathers_name = $request->fathers_name;
        $staff->mothers_name = $request->mothers_name;
        $staff->email = $request->email;
        $staff->staff_photo = $staff_photo;
        $staff->gender_id = $request->gender_id;
        $staff->marital_status = $request->marital_status;
        $staff->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
        $staff->date_of_joining = date('Y-m-d', strtotime($request->date_of_joining));
        $staff->mobile = $request->mobile;
        $staff->emergency_mobile = $request->emergency_mobile;
        $staff->current_address = $request->current_address;
        $staff->permanent_address = $request->permanent_address;
        $staff->qualification = $request->qualification;
        $staff->experience = $request->experience;
        $staff->epf_no = $request->epf_no;
        $staff->basic_salary = $basic_salary;
        $staff->contract_type = $request->contract_type;
        $staff->location = $request->location;
        $staff->bank_account_name = $request->bank_account_name;
        $staff->bank_account_no = $request->bank_account_no;
        $staff->bank_name = $request->bank_name;
        $staff->bank_brach = $request->bank_brach;
        $staff->facebook_url = $request->facebook_url;
        $staff->twiteer_url = $request->twiteer_url;
        $staff->linkedin_url = $request->linkedin_url;
        $staff->instragram_url = $request->instragram_url;
        $staff->school_id = 1;
        $staff->user_id = $staff->user_id;
        $staff->resume = $resume;
        $staff->joining_letter = $joining_letter;
        $staff->other_document = $other_document;
        $result = $staff->update();

        if ($result) {
            $user = User::find($staff->user_id);
            $user->username = $request->email;
            $user->email = $request->email;
            $user->full_name = $request->first_name . ' ' . $request->last_name;
            $user->update();

            return redirect('staff-directory')->with('message-success', 'Staff has been updated successfully');
        }else{
            
            return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
        }

    }

    public function viewStaff($id)
    {
        $staffDetails = SmStaff::find($id);
        if (!empty($staffDetails)) {
            $staffPayrollDetails = SmHrPayrollGenerate::where('staff_id', $id)->where('payroll_status', '!=', 'NG')->get();
            $staffLeaveDetails = SmLeaveRequest::where('staff_id', $id)->get();
            $staffDocumentsDetails = SmStudentDocument::where('student_staff_id', $id)->where('type', '=', 'stf')->get();
            $timelines = SmStudentTimeline::where('staff_student_id', $id)->where('type', '=', 'stf')->get();
            return view('backEnd.humanResource.viewStaff', compact('staffDetails', 'staffPayrollDetails', 'staffLeaveDetails', 'staffDocumentsDetails', 'timelines'));
        } else {
            return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
        }
    }

    public function searchStaff(Request $request)
    {
        $staff = SmStaff::query();
        $staff->where('active_status', 1);
        if ($request->role_id != "") {
            $staff->where('role_id', $request->role_id);
        }
        if ($request->staff_no != "") {
            $staff->where('staff_no', $request->staff_no);
        }

        if ($request->staff_name != "") {
            $staff->where('full_name', 'like', '%' . $request->staff_name . '%');
        }
        $staffs = $staff->get();
        $roles = Role::where('active_status', '=', '1')->where('id', '!=', 2)->where('id', '!=', 3)->get();

        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            $data=[];
            $data['staffs']= $staffs->toArray();
            $data['roles']= $roles->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.humanResource.staff_list', compact('staffs', 'roles'));

    }

    public function uploadStaffDocuments($staff_id)
    {
        return view('backEnd.humanResource.uploadStaffDocuments', compact('staff_id'));
    }

    public function saveUploadDocument(Request $request)
    {
        if ($request->file('staff_upload_document') != "" && $request->title != "") {
            $document_photo = "";
            if ($request->file('staff_upload_document') != "") {
                $file = $request->file('staff_upload_document');
                $document_photo = 'staff-' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/staff/document/', $document_photo);
                $document_photo = 'public/uploads/staff/document/' . $document_photo;
            }

            $document = new SmStudentDocument();
            $document->title = $request->title;
            $document->student_staff_id = $request->staff_id;
            $document->type = 'stf';
            $document->file = $document_photo;
            $document->created_by = Auth()->user()->id;
            $results = $document->save();
        }

        if ($results) {
            return redirect()->back()->with('message-success', 'New Document has been created successfully');
        } else {
            return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
        }
    }

    public function deleteStaffDocumentView(Request $request,$id)
    {
        if(ApiBaseMethod::checkUrl($request->fullUrl())){
            return ApiBaseMethod::sendResponse($id, null);
        }
        return view('backEnd.humanResource.deleteStaffDocumentView', compact('id'));
    }

    public function deleteStaffDocument($id)
    {
        $result = SmStudentDocument::destroy($id);
        if ($result) {
            return redirect()->back()->with('message-success-delete', 'Document has been deleted successfully');
        } else {
            return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
        }
    }

    public function addStaffTimeline($id)
    {
        return view('backEnd.humanResource.addStaffTimeline', compact('id'));
    }

    public function storeStaffTimeline(Request $request)
    {
        if ($request->title != "") {

            $document_photo = "";
            if ($request->file('document_file_4') != "") {
                $file = $request->file('document_file_4');
                $document_photo = 'stu-' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/staff/timeline/', $document_photo);
                $document_photo = 'public/uploads/staff/timeline/' . $document_photo;
            }

            $timeline = new SmStudentTimeline();
            $timeline->staff_student_id = $request->staff_student_id;
            $timeline->title = $request->title;
            $timeline->type = 'stf';
            $timeline->date = date('Y-m-d', strtotime($request->date));
            $timeline->description = $request->description;
            if (isset($request->visible_to_student)) {
                $timeline->visible_to_student = $request->visible_to_student;
            }
            $timeline->file = $document_photo;
            $timeline->save();
        }
        return redirect()->back();
    }

    public function deleteStaffTimelineView($id)
    {
        return view('backEnd.humanResource.deleteStaffTimelineView', compact('id'));
    }

    public function deleteStaffTimeline($id)
    {
        $result = SmStudentTimeline::destroy($id);
        if ($result) {
            return redirect()->back()->with('message-success-delete', 'Timeline has been deleted successfully');
        } else {
            return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
        }
    }

    public function deleteStaffView($id)
    {
        return view('backEnd.humanResource.deleteStaffView', compact('id'));
    }

    public function deleteStaff($id)
    {
        $staffs = SmStaff::find($id);
        $staffs->active_status = 0;
        $result = $staffs->update();

        if ($result) {
            $users = User::find($staffs->user_id);
            $users->active_status = 0;
            $results = $users->update();
        }

        return redirect()->back()->with('message-success', 'Staff successfully Deleted');

    }
}
