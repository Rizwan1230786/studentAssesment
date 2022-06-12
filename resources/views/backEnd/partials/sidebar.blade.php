
@php
$module_links = [];

$permissions = App\SmRolePermission::where('role_id', Auth::user()->role_id)->get();
$module_links = [];
$modules = [];

foreach($permissions as $permission){
    $module_links[] = $permission->module_link_id;
    $modules[] = $permission->moduleLink->module_id;
}

$modules = array_unique($modules);

    if(Auth::user()->role_id == 3){
        $childrens = App\SmParent::myChildrens();
    }

$generalSetting=App\SmGeneralSettings::where('id',1)->first();
if(isset($generalSetting->logo)){ $logo = $generalSetting->logo; }else{ $logo = 'public/uploads/settings/logo.png'; } 


@endphp

<input type="hidden" name="url" id="url" value="{{url('/')}}">

<nav id="sidebar">
    <div class="sidebar-header">
        <a href="{{url('/')}}">
            <img src="{{asset('/'.$generalSetting->logo)}}" alt="">
        </a>
    </div>

    <ul class="list-unstyled components">
        @if(Auth::user()->role_id != 2 && Auth::user()->role_id != 3 && Auth::user()->role_id != 10 )
            <li>
                <a href="{{url('/admin-dashboard')}}" id="admin-dashboard">

                    <span class="flaticon-speedometer"></span>
                    dashboard
                </a>
            </li>




            @if(in_array(2, $modules) || Auth::user()->role_id == 1)
            <li>
                <a href="#subMenuAdmin" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-analytics"></span>
                    admin_section
                </a>
                <ul class="collapse list-unstyled" id="subMenuAdmin">
                    @if(in_array(1, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('admission_query')}}">@lang('lang.admission_query')</a>
                    </li>
                    @endif
                    @if(in_array(2, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('visitor')}}">@lang('lang.visitor_book') </a>
                    </li>
                    @endif
                    @if(in_array(3, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('complaint')}}">@lang('lang.complaint')</a>
                    </li>
                    @endif
                    @if(in_array(4, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('postal-receive')}}">@lang('lang.postal_receive')</a>
                    </li>
                    @endif
                    @if(in_array(5, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('postal-dispatch')}}">@lang('lang.postal_dispatch')</a>
                    </li>
                    @endif
                    @if(in_array(6, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('phone-call')}}">@lang('lang.phone_call_log')</a>
                    </li>
                    @endif
                    @if(in_array(7, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('setup-admin')}}">@lang('lang.admin_setup')</a>
                    </li>
                    @endif
                    @if(in_array(8, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('student-certificate')}}">@lang('lang.student_certificate')</a>
                    </li>
                    @endif
                    @if(in_array(9, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('generate_certificate')}}">@lang('lang.generate_certificate')</a>
                    </li>
                    @endif
                    @if(in_array(10, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('student-id-card')}}">@lang('lang.student_id_card')</a>
                    </li>
                    @endif
                    @if(in_array(11, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('generate_id_card')}}">@lang('lang.generate_id_card')</a>
                    </li>
                    @endif
                </ul>
            </li>

            @endif


             

            @if(in_array(3, $modules) || Auth::user()->role_id == 1)
            <li>
                <a href="#subMenuStudent" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-reading"></span>
                    @lang('lang.student_information')
                </a>
                <ul class="collapse list-unstyled" id="subMenuStudent">
                    @if(in_array(12, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('student_admission')}}">@lang('lang.student_admission')</a>
                    </li>
                    @endif
                    @if(in_array(13, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('student_list')}}">@lang('lang.student_list')</a>
                    </li>
                    @endif
                    

                    @if(in_array(14, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('student_attendance')}}">@lang('lang.student_attendance')</a>
                    </li>
                    @endif

                    @if(in_array(15, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('student_attendance_report')}}">@lang('lang.student_attendance_report')</a>
                    </li>
                    @endif
                    @if(in_array(16, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('student_category')}}">@lang('lang.student_category')</a>
                    </li>
                    @endif
                    @if(in_array(17, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('student_group')}}">@lang('lang.student_group')</a>
                    </li>
                    @endif

                    @if(in_array(18, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('student_promote')}}">@lang('lang.student_promote')</a>
                    </li>
                    @endif

                    @if(in_array(19, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('disabled_student')}}">@lang('lang.disabled_student')</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif



            @if(in_array(4, $modules) || Auth::user()->role_id == 1)
            <li>
                <a href="#subMenuTeacher" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-professor"></span>
                    @lang('lang.teacher')
                </a>

                <ul class="collapse list-unstyled" id="subMenuTeacher">
                    @if(in_array(20, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('upload-content')}}">@lang('lang.upload_content')</a>
                    </li>
                    @endif

                    @if(in_array(21, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('assignment-list')}}">@lang('lang.assignment')</a>
                    </li>
                    @endif

                    @if(in_array(22, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('study-metarial-list')}}">@lang('lang.study_material')</a>
                    </li>
                    @endif

                    @if(in_array(23, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('syllabus-list')}}">@lang('lang.syllabus')</a>
                    </li>
                    @endif

                    @if(in_array(24, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('other-download-list')}}">@lang('lang.other_download')</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif


            @if(in_array(5, $modules) || Auth::user()->role_id == 1)
            <li>
                <a href="#subMenuFeesCollection" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-wallet"></span>
                    @lang('lang.fees_collection')
                </a>
                <ul class="collapse list-unstyled" id="subMenuFeesCollection">
                     @if(in_array(25, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('collect_fees')}}">@lang('lang.collect_fees')</a>
                    </li>
                    @endif
                    @if(in_array(26, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('search_fees_payment')}}">@lang('lang.search_fees_payment')</a>
                    </li>
                    @endif
                    @if(in_array(27, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('search_fees_due')}}">@lang('lang.search_fees_due')</a>
                    </li>
                    @endif
                    @if(in_array(28, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('fees-master')}}">@lang('lang.fees_master')</a>
                    </li>
                    @endif
                    @if(in_array(29, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('fees_group')}}">@lang('lang.fees_group')</a>
                    </li>
                    @endif
                    @if(in_array(30, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('fees_type')}}">@lang('lang.fees_type')</a>
                    </li>
                    @endif
                    @if(in_array(31, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('fees_discount')}}">@lang('lang.fees_discount')</a>
                    </li>
                    @endif
                    @if(in_array(32, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('fees_forward')}}">@lang('lang.fees_forward')</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif


            @if(in_array(6, $modules) || Auth::user()->role_id == 1)
            <li>
                <a href="#subMenuAccount" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-accounting"></span>
                    @lang('lang.accounts')
                </a>
                <ul class="collapse list-unstyled" id="subMenuAccount">

                    @if(in_array(33, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('profit')}}">@lang('lang.profit')</a>
                    </li>
                    @endif
                    @if(in_array(34, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('add_income')}}">@lang('lang.income')</a>
                    </li>
                    @endif
                    @if(in_array(35, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('add-expense')}}">@lang('lang.expense')</a>
                    </li>
                    @endif
                    @if(in_array(36, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('search_account')}}">@lang('lang.search')</a>
                    </li>
                    @endif
                    @if(in_array(37, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('chart-of-account')}}">@lang('lang.chart_of_account')</a>
                    </li>
                    @endif
                    @if(in_array(38, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('payment_method')}}">@lang('lang.payment_method')</a>
                    </li>
                    @endif
                    @if(in_array(39, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('bank-account')}}">@lang('lang.bank_account')</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif


            @if(in_array(7, $modules) || Auth::user()->role_id == 1)
            <li>
                <a href="#subMenuHumanResource" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-consultation"></span>
                    @lang('lang.human_resource')
                </a>
                <ul class="collapse list-unstyled" id="subMenuHumanResource">
                    @if(in_array(40, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('staff_directory')}}">@lang('lang.staff_directory')</a>
                    </li>
                    @endif
                    @if(in_array(41, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('staff_attendance')}}">@lang('lang.staff_attendance')</a>
                    </li>
                    @endif
                    @if(in_array(42, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('staff_attendance_report')}}">@lang('lang.staff_attendance_report')</a>
                    </li>
                   @endif
                    @if(in_array(43, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('payroll')}}">@lang('lang.payroll')</a>
                    </li>
                   @endif
                    @if(in_array(44, $module_links) || Auth::user()->role_id == 1)
                     <li>
                         <a href="{{url('payroll-report')}}">@lang('lang.payroll_report')</a>
                     </li>
                     @endif
                     @if(in_array(45, $module_links) || Auth::user()->role_id == 1)
                     <li>
                         <a href="{{url('designation')}}">@lang('lang.designation')</a>
                     </li>
                     @endif
                     @if(in_array(46, $module_links) || Auth::user()->role_id == 1)
                     <li>
                         <a href="{{url('department')}}">@lang('lang.department')</a>
                     </li>
                     @endif
                </ul>
            </li>
            @endif

            @if(in_array(8, $modules) || Auth::user()->role_id == 1)
            <li>
                <a href="#subMenuLeaveManagement" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-slumber"></span>
                    @lang('lang.leave')
                </a>
                <ul class="collapse list-unstyled" id="subMenuLeaveManagement">
                    @if(in_array(47, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('approve-leave')}}">@lang('lang.approve_leave_request')</a>
                    </li>
                    @endif
                    @if(in_array(48, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('apply-leave')}}">@lang('lang.apply_leave')</a>
                    </li>
                    @endif
                    @if(in_array(49, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('leave-define')}}">@lang('lang.leave_define')</a>
                    </li>
                    @endif
                    @if(in_array(50, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('leave-type')}}">@lang('lang.leave_type')</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif



            @if(in_array(9, $modules) || Auth::user()->role_id == 1)
            <li>
                <a href="#subMenuExam" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-test"></span>
                    @lang('lang.examination')
                </a>
                <ul class="collapse list-unstyled" id="subMenuExam">
                    @if(in_array(51, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('exam-type')}}">@lang('lang.add_exam_type')</a>
                    </li>
                    @endif
                    @if(in_array(52, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('exam')}}"> @lang('lang.exam_setup')</a>
                    </li>
                    @endif

                    @if(in_array(53, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('exam_schedule')}}">@lang('lang.exam_schedule')</a>
                    </li>
                    @endif
                    @if(in_array(54, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('marks_register')}}">@lang('lang.marks_register')</a>
                    </li>
                    @endif
                    
                    @if(in_array(55, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('exam_attendance')}}">@lang('lang.exam_attendance')</a>
                    </li>
                    @endif
                    @if(in_array(56, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('marks-grade')}}">@lang('lang.marks_grade')</a>
                    </li>
                    @endif
                    @if(in_array(57, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('send_marks_by_sms')}}">@lang('lang.send_marks_by_sms')</a>
                    </li>
                    @endif
                    @if(in_array(58, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('question-group')}}">@lang('lang.question_group')</a>
                    </li>
                    @endif
                    @if(in_array(59, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('question-bank')}}">@lang('lang.question_bank')</a>
                    </li>
                    @endif
                    @if(in_array(60, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('online-exam')}}">@lang('lang.online_exam')</a>
                    </li>
                    @endif
                    
                </ul>
            </li>
            @endif



            @if(in_array(10, $modules) || Auth::user()->role_id == 1 || Auth::user()->role_id == 4)
            <li>
                <a href="#subMenuAcademic" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-graduated-student"></span>
                    @lang('lang.academics')
                </a>
                <ul class="collapse list-unstyled" id="subMenuAcademic">
                    @if(in_array(61, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('class_routine_new')}}">@lang('lang.class_routine')</a>

                    </li>
                    @endif

                    <!-- only for teacher -->
                    @if(Auth::user()->role_id == 4)
                    <li>
                        <a href="{{url('view-teacher-routine')}}">View Class Routine</a>
                    </li>
                    @endif

                    @if(in_array(62, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('assign_subject')}}">@lang('lang.assign_subject')</a>
                    </li>
                    @endif
                    @if(in_array(63, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('assign-class-teacher')}}">@lang('lang.assign_class_teacher')</a>
                    </li>
                    @endif
                    @if(in_array(64, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('subject')}}">@lang('lang.subjects')</a>
                    </li>
                    @endif
                    @if(in_array(65, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('class')}}">@lang('lang.class')</a>
                    </li>
                    @endif
                    @if(in_array(66, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('section')}}">@lang('lang.section')</a>
                    </li>
                    @endif
                    @if(in_array(67, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('class-room')}}">@lang('lang.class_room')</a>
                    </li>
                    @endif
                    @if(in_array(68, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('class-time')}}">@lang('lang.cl_ex_time_setup')</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            @if(in_array(11, $modules) || Auth::user()->role_id == 1)
             <li>
                <a href="#subMenuHomework" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-book"></span>
                    @lang('lang.home_work')
                </a>
                <ul class="collapse list-unstyled" id="subMenuHomework">
                    @if(in_array(69, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('add-homeworks')}}"> @lang('lang.add_homework')</a>
                    </li>
                    @endif
                    @if(in_array(70, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('homework-list')}}">@lang('lang.homework_list')</a>
                    </li>
                    @endif
                    @if(in_array(71, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('evaluation-report')}}">@lang('lang.evaluation_report')</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif


            @if(in_array(12, $modules) || Auth::user()->role_id == 1)
            <li>
                <a href="#subMenuCommunicate" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-email"></span>
                    @lang('lang.communicate')
                </a>
                <ul class="collapse list-unstyled" id="subMenuCommunicate">
                    @if(in_array(72, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('notice-list')}}">@lang('lang.notice_board')</a>
                    </li>
                    @endif
                    @if(in_array(73, $module_links) || Auth::user()->role_id == 1)
                    <li>
                         <a href="{{url('send-message')}}">@lang('lang.send_message')</a>
                    </li>
                    @endif
                    @if(in_array(74, $module_links) || Auth::user()->role_id == 1)
                     <li>
                         <a href="{{url('send-email-sms-view')}}">@lang('lang.send_email')</a>
                    </li>
                    @endif
                    @if(in_array(75, $module_links) || Auth::user()->role_id == 1)
                    <li>
                         <a href="{{url('email-sms-log')}}">@lang('lang.email_sms_log')</a>
                    </li>
                    @endif
                    @if(in_array(76, $module_links) || Auth::user()->role_id == 1)
                   <li>
                         <a href="{{url('event')}}">@lang('lang.event')</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif


            @if(in_array(13, $modules) || Auth::user()->role_id == 1)
            <li>
                <a href="#subMenulibrary" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-book-1"></span>
                    @lang('lang.library')
                </a>
                <ul class="collapse list-unstyled" id="subMenulibrary">
                    @if(in_array(77, $module_links) || Auth::user()->role_id == 1)
                     <li>
                        <a href="{{url('add-book')}}"> @lang('lang.add_book')</a>
                    </li>
                    @endif
                    @if(in_array(78, $module_links) || Auth::user()->role_id == 1)
                     <li>
                        <a href="{{url('book-list')}}"> @lang('lang.book_list')</a>
                    </li>
                    @endif
                    @if(in_array(79, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('book-category-list')}}">@lang('lang.book_category')</a>
                    </li>
                    @endif
                    @if(in_array(80, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('library-member')}}">@lang('lang.library_member')</a>
                    </li>
                    @endif
                    @if(in_array(81, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('member-list')}}"> @lang('lang.member_list')</a>
                    </li>
                    @endif
                    @if(in_array(82, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('all-issed-book')}}">@lang('lang.all_issued_book')</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            @if(in_array(14, $modules) || Auth::user()->role_id == 1)
            <li>
                <a href="#subMenuInventory" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-inventory"></span>
                    @lang('lang.inventory')
                </a>
                <ul class="collapse list-unstyled" id="subMenuInventory">
                    @if(in_array(83, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('item-category')}}">@lang('lang.item_category')</a>
                    </li>
                    @endif
                    @if(in_array(84, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('item-list')}}">@lang('lang.item_list')</a>
                    </li>
                    @endif
                    @if(in_array(85, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('item-store')}}">@lang('lang.item_store')</a>
                    </li>
                    @endif
                    @if(in_array(86, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('suppliers')}}">@lang('lang.supplier')</a>
                    </li>
                    @endif
                    @if(in_array(87, $module_links) || Auth::user()->role_id == 1)
                     <li>
                        <a href="{{url('item-receive')}}">@lang('lang.item_receive')</a>
                    </li>
                    @endif
                    @if(in_array(88, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('item-receive-list')}}">@lang('lang.item_receive_list')</a>
                    </li>
                    @endif
                    @if(in_array(89, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('item-sell-list')}}">@lang('lang.item_sell')</a>
                    </li>
                    @endif
                    @if(in_array(90, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('item-issue')}}">@lang('lang.item_issue')</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            @if(in_array(15, $modules) || Auth::user()->role_id == 1)
            <li>
                <a href="#subMenuTransport" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-bus"></span>
                    @lang('lang.transport')
                </a>
                <ul class="collapse list-unstyled" id="subMenuTransport">
                    @if(in_array(91, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('transport-route')}}">@lang('lang.routes')</a>
                    </li>
                    @endif
                    @if(in_array(92, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('vehicle')}}">@lang('lang.vehicle')</a>
                    </li>
                    @endif
                    @if(in_array(93, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('assign-vehicle')}}">@lang('lang.assign_vehicle')</a>
                    </li>
                    @endif
                    @if(in_array(94, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('student_transport_report')}}">@lang('lang.student_transport_report')</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            @if(in_array(16, $modules) || Auth::user()->role_id == 1)
            <li>
                <a href="#subMenuDormitory" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-hotel"></span>
                    @lang('lang.dormitory')
                </a>
                <ul class="collapse list-unstyled" id="subMenuDormitory">
                    @if(in_array(95, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('room-list')}}"> @lang('lang.dormitory_rooms')</a>
                    </li>
                    @endif
                    @if(in_array(96, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('dormitory-list')}}">@lang('lang.dormitory')</a>
                    </li>
                    @endif
                    @if(in_array(97, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('room-type')}}">@lang('lang.room_type')</a>
                    </li>
                    @endif
                    @if(in_array(98, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('student_dormitory_report')}}">@lang('lang.student_dormitory_report')</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            @if(in_array(17, $modules) || Auth::user()->role_id == 1)
            <li>
                <a href="#subMenusystemReports" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-analysis"></span>
                    @lang('lang.reports')
                </a>
                <ul class="collapse list-unstyled" id="subMenusystemReports">
                    @if(in_array(99, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('student_report')}}">@lang('lang.student_report')</a>
                    </li>
                    @endif
                    @if(in_array(100, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('guardian_report')}}">@lang('lang.guardian_report')</a>
                    </li>
                    @endif
                    @if(in_array(101, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('student_history')}}">@lang('lang.student_history')</a>
                    </li>
                    @endif
                    @if(in_array(102, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('student_login_report')}}">@lang('lang.student_login_report')</a>
                    </li>
                    @endif
                    @if(in_array(103, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('fees_statement')}}">@lang('lang.fees_statement')</a>
                    </li>
                    @endif
                    @if(in_array(104, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('balance_fees_report')}}">@lang('lang.balance_fees_report')</a>
                    </li>
                    @endif
                    @if(in_array(105, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('transaction_report')}}">@lang('lang.transaction_report')</a>
                    </li>
                    @endif
                    @if(in_array(106, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('class_report')}}">@lang('lang.class_report')</a>
                    </li>
                    @endif
                    @if(in_array(107, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('class_routine_report')}}">@lang('lang.class_routine')</a>
                    </li>
                    @endif
                    @if(in_array(108, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('exam_routine_report')}}">@lang('lang.exam_routine')</a>
                    </li>
                    @endif
                    @if(in_array(109, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('teacher_class_routine_report')}}">@lang('lang.teacher') @lang('lang.class_routine')</a>
                    </li>
                    @endif
                    @if(in_array(110, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('merit_list_report')}}">@lang('lang.merit_list_report')</a>
                    </li>
                    @endif
                    @if(in_array(111, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('online_exam_report')}}">@lang('lang.online_exam_report')</a>
                    </li>
                    @endif
                    @if(in_array(112, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('mark_sheet_report_student')}}">@lang('lang.mark_sheet_report')</a>
                    </li>
                    @endif
                    @if(in_array(113, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('tabulation_sheet_report')}}">@lang('lang.tabulation_sheet_report')</a>
                    </li>
                    @endif
                    @if(in_array(114, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('progress_card_report')}}">Progress Card Report</a>
                    </li>
                    @endif
                    @if(in_array(115, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('student_fine_report')}}">@lang('lang.student_fine_report')</a>
                    </li>
                    @endif
                    @if(in_array(116, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('user_log')}}">@lang('lang.user_log')</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif


            @if(in_array(18, $modules) || Auth::user()->role_id == 1)
            <li>
                <a href="#subMenusystemSettings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <span class="flaticon-settings"></span>
                    @lang('lang.system_settings')
                </a>
                <ul class="collapse list-unstyled" id="subMenusystemSettings">
                    @if(in_array(117, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('general-settings')}}"> @lang('lang.general_settings')</a>
                    </li>
                    @endif
                    @if(in_array(118, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('email-settings')}}">@lang('lang.email_settings')</a>
                    </li>
                    @endif
                    @if(in_array(119, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('payment-method-settings')}}">@lang('lang.payment_method_settings')</a>
                    </li>
                    @endif
                    @if(in_array(120, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('role')}}">@lang('lang.role')</a>
                    </li>
                    @endif
                    @if(in_array(121, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('base_group')}}">@lang('lang.base_group')</a>
                    </li>
                    @endif
                    @if(in_array(122, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{route('base_setup')}}">@lang('lang.base_setup')</a>
                    </li>
                    @endif
                    @if(in_array(123, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('academic-year')}}">@lang('lang.academic_year')</a>
                    </li>
                    @endif
                    @if(in_array(124, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('session')}}">@lang('lang.session')</a>
                    </li>
                    @endif
                    @if(in_array(125, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('holiday')}}">@lang('lang.holiday')</a>
                    </li>
                    @endif
                    @if(in_array(126, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('sms-settings')}}">@lang('lang.sms_settings')</a>
                    </li>
                    @endif
                    @if(in_array(127, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('weekend')}}">@lang('lang.weekend')</a>
                    </li>
                    @endif
                    @if(in_array(128, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('language-settings')}}">@lang('lang.language_settings')</a>
                    </li>
                    @endif
                    @if(in_array(129, $module_links) || Auth::user()->role_id == 1)
                    <li>
                        <a href="{{url('backup-settings')}}">@lang('lang.backup_settings')</a>
                    </li>
                    @endif
{{--                    @if(in_array(130, $module_links) || Auth::user()->role_id == 1)--}}
{{--                    <li>--}}
{{--                        <a href="{{url('update-system')}}">@lang('lang.update_system')</a>--}}
{{--                    </li>--}}
{{--                    @endif--}}
                </ul>
            </li>
            @endif
            @if(in_array(19, $modules) || Auth::user()->role_id == 1)
                <li>
                    <a href="#subMenufrontEndSettings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <span class="flaticon-software"></span>
                        @lang('lang.front_settings')
                    </a>
                    <ul class="collapse list-unstyled" id="subMenufrontEndSettings">

                        <li>
                            <a href="{{url('news')}}">@lang('lang.news_list')</a>
                        </li>
                        <li>
                            <a href="{{url('news-category')}}">@lang('lang.news') @lang('lang.category')</a>
                        </li>
                        <li>
                            <a href="{{url('testimonial')}}">@lang('lang.testimonial')</a>
                        </li>
                        <li>
                            <a href="{{url('course-list')}}">Course List</a>
                        </li>
                        <li>
                            <a href="{{url('contact-page')}}">Contact Page</a>
                        </li>
                        <li>
                            <a href="{{url('contact-message')}}">Contact Message</a>
                        </li>
                        <li>
                            <a href="{{url('about-page')}}">About Us</a>
                        </li>
                    </ul>
                </li>
            @endif
        @endif

        <!-- Student Panel -->
        @if(Auth::user()->role_id == 2)
        <li>
            <a href="{{route('student_dashboard')}}">
                <span class="flaticon-resume"></span>
                @lang('lang.my_profile')
            </a>
        </li>
        <li>
            <a href="#subMenuStudentFeesCollection" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" href="#">
                <span class="flaticon-wallet"></span>
                @lang('lang.fees')
            </a>
             <ul class="collapse list-unstyled" id="subMenuStudentFeesCollection">
                <li>
                    <a href="{{route('student_fees')}}">@lang('lang.pay_fees')</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{route('student_class_routine')}}">
                <span class="flaticon-calendar-1"></span>
                @lang('lang.class_routine')
            </a>
        </li>
        <li>
            <a href="{{route('student_homework')}}">
                <span class="flaticon-book"></span>
                @lang('lang.home_work')
            </a>
        </li>
        <li>
            <a href="#subMenuDownloadCenter" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" href="#">
                <span class="flaticon-data-storage"></span>
                @lang('lang.download_center')
            </a>
             <ul class="collapse list-unstyled" id="subMenuDownloadCenter">
                <li>
                    <a href="{{route('student_assignment')}}">@lang('lang.assignment')</a>
                </li>
                <li>
                    <a href="{{route('student_study_material')}}">@lang('lang.student_study_material')</a>
                </li>
                <li>
                    <a href="{{route('student_syllabus')}}">@lang('lang.syllabus')</a>
                </li>
                <li>
                    <a href="{{route('student_others_download')}}">@lang('lang.other_download')</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{route('student_my_attendance')}}">
                <span class="flaticon-authentication"></span>
                @lang('lang.attendance')
            </a>
        </li>
        <li>
            <a href="#subMenuStudentExam" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" href="#">
                <span class="flaticon-test"></span>
                @lang('lang.examinations')
            </a>
             <ul class="collapse list-unstyled" id="subMenuStudentExam">
                <li>
                    <a href="{{route('student_result')}}">@lang('lang.result')</a>
                 </li>
                 <li>
                    <a href="{{route('student_exam_schedule')}}">@lang('lang.exam_schedule')</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#subMenuStudentOnlineExam" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" href="#">
                <span class="flaticon-test-1"></span>
                @lang('lang.online_exam')
            </a>
             <ul class="collapse list-unstyled" id="subMenuStudentOnlineExam">
                <li>
                    <a href="{{route('student_online_exam')}}">@lang('lang.active_exams')</a>
                 </li>
                 <li>
                    <a href="{{route('student_view_result')}}">@lang('lang.view_result')</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="{{route('student_noticeboard')}}">
                <span class="flaticon-poster"></span>
                @lang('lang.notice_board')
            </a>
        </li>
        <li>
            <a href="{{route('student_subject')}}">
                <span class="flaticon-reading-1"></span>
                @lang('lang.subjects')
            </a>
        </li>
         <li>
            <a href="{{route('student_teacher')}}">
                <span class="flaticon-professor"></span>
                @lang('lang.teacher')
            </a>
        </li>
         <li>
            <a href="#subMenuStudentLibrary" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" href="#">
                <span class="flaticon-book-1"></span>
                @lang('lang.library')
            </a>
             <ul class="collapse list-unstyled" id="subMenuStudentLibrary">
                <li>
                    <a href="{{route('student_library')}}"> @lang('lang.book_list')</a>
                 </li>
                 <li>
                    <a href="{{route('student_book_issue')}}">@lang('lang.book_issue')</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{route('student_transport')}}">
                <span class="flaticon-bus"></span>
                @lang('lang.transport')
            </a>
        </li>
        <li>
            <a href="{{route('student_dormitory')}}">
                <span class="flaticon-hotel"></span>
                @lang('lang.dormitory')
            </a>
        </li>
        @endif
        <!-- End student panel -->

        <!-- Student Panel -->
        @if(Auth::user()->role_id == 3)
        <li>
            <a href="#subMenuParentMyChildren" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <span class="flaticon-reading"></span>
                @lang('lang.my_children')
            </a>
            <ul class="collapse list-unstyled" id="subMenuParentMyChildren">
                @foreach($childrens as $children)
                <li>
                    <a href="{{route('my_children', [$children->id])}}">{{$children->full_name}}</a>
                </li>
                @endforeach
            </ul>
        </li>
        <li>
            <a href="#subMenuParentFees" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <span class="flaticon-wallet"></span>
                @lang('lang.fees')
            </a>
            <ul class="collapse list-unstyled" id="subMenuParentFees">
                @foreach($childrens as $children)
                <li>
                    <a href="{{route('parent_fees', [$children->id])}}">{{$children->full_name}}</a>
                </li>
                @endforeach
            </ul>
        </li>
        <li>
            <a href="#subMenuParentClassRoutine" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <span class="flaticon-calendar-1"></span>
                @lang('lang.class_routine')
            </a>
            <ul class="collapse list-unstyled" id="subMenuParentClassRoutine">
                @foreach($childrens as $children)
                <li>
                    <a href="{{route('parent_class_routine', [$children->id])}}">{{$children->full_name}}</a>
                </li>
                @endforeach
            </ul>
        </li>
        <li>
            <a href="#subMenuParentHomework" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <span class="flaticon-book"></span>
                @lang('lang.home_work')
            </a>
            <ul class="collapse list-unstyled" id="subMenuParentHomework">
                @foreach($childrens as $children)
                <li>
                    <a href="{{route('parent_homework', [$children->id])}}">{{$children->full_name}}</a>
                </li>
                @endforeach
            </ul>
        </li>
        <li>
            <a href="#subMenuParentAttendance" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <span class="flaticon-authentication"></span>
                @lang('lang.attendance')
            </a>
            <ul class="collapse list-unstyled" id="subMenuParentAttendance">
                @foreach($childrens as $children)
                <li>
                    <a href="{{route('parent_attendance', [$children->id])}}">{{$children->full_name}}</a>
                </li>
                @endforeach
            </ul>
        </li>
        <li>
            <a href="#subMenuParentExamination" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <span class="flaticon-test"></span>
                @lang('lang.exam_result')
            </a>
            <ul class="collapse list-unstyled" id="subMenuParentExamination">
                @foreach($childrens as $children)
                <li>
                    <a href="{{route('parent_examination', [$children->id])}}">{{$children->full_name}}</a>
                </li>
                @endforeach
            </ul>
        </li>
        <li>
            <a href="{{route('parent_noticeboard')}}">
                <span class="flaticon-poster"></span>
                @lang('lang.notice_board')
            </a>
        </li>
        <li>
            <a href="#subMenuParentSubject" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <span class="flaticon-reading-1"></span>
                @lang('lang.subjects')
            </a>
            <ul class="collapse list-unstyled" id="subMenuParentSubject">
                @foreach($childrens as $children)
                <li>
                    <a href="{{route('parent_subjects', [$children->id])}}">{{$children->full_name}}</a>
                </li>
                @endforeach
            </ul>
        </li>
        
        <li>
            <a href="#subMenuParentTeacher" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <span class="flaticon-professor"></span>
                @lang('lang.teacher_list')
            </a>
            <ul class="collapse list-unstyled" id="subMenuParentTeacher">
                @foreach($childrens as $children)
                <li>
                    <a href="{{route('parent_teacher_list', [$children->id])}}">{{$children->full_name}}</a>
                </li>
                @endforeach
            </ul>
        </li>
        <li>
            <a href="#subMenuParentTransport" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <span class="flaticon-bus"></span>
                @lang('lang.transport')
            </a>
            <ul class="collapse list-unstyled" id="subMenuParentTransport">
                @foreach($childrens as $children)
                <li>
                    <a href="{{route('parent_transport', [$children->id])}}">{{$children->full_name}}</a>
                </li>
                @endforeach
            </ul>
        </li>
        <li>
            <a href="#subMenuParentDormitory" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <span class="flaticon-hotel"></span>
                @lang('lang.dormitory_list')
            </a>
            <ul class="collapse list-unstyled" id="subMenuParentDormitory">
                @foreach($childrens as $children)
                <li>
                    <a href="{{route('parent_dormitory', [$children->id])}}">{{$children->full_name}}</a>
                </li>
                @endforeach
            </ul>
        </li>
        @endif


        @if(Auth::user()->role_id == 10)

            <li>
                <a href="{{url('/customer-dashboard')}}" id="customer-dashboard">

                    <span class="flaticon-speedometer"></span>
                    @lang('lang.dashboard')
                </a>
            </li>

        <li>
            <a href="#SubMenuCustomerProfile" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <span class="flaticon-hotel"></span>
                Profile
            </a>
            <ul class="collapse list-unstyled" id="SubMenuCustomerProfile"> 
                <li>
                    <a href="#">View Profile</a>
                </li> 
                <li>
                    <a href="#">Update Profile</a>
                </li> 
                <li>
                    <a href="{{url('/change-password')}}">Change Password</a>
                </li> 
            </ul>
        </li>

        <li>
            <a href="#SubMenuCustomerHistory" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <span class="flaticon-hotel"></span>
                History
            </a>
            <ul class="collapse list-unstyled" id="SubMenuCustomerHistory"> 
                <li>
                    <a href="{{url('/customer-purchases')}}">Purchases</a>
                </li> 
                <li>
                    <a href="#">Payment</a>
                </li>  
            </ul>
        </li>

        @endif

    </ul>
</nav>
