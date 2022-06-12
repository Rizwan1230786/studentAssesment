<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmModuleLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_module_links', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('module_id')->nullable();
            $table->string('name')->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
        DB::table('sm_module_links')->insert([
            [
                'name' => 'Admission Query', // Admin Section
                'module_id' => 2,
            ],[
                'name' => 'Visitor Book', 
                'module_id' => 2,
            ],[
                'name' => 'Complaint', 
                'module_id' => 2,
            ],[
                'name' => 'Postal Receive', 
                'module_id' => 2,
            ],[
                'name' => 'Postal Dispatch', 
                'module_id' => 2,
            ],[
                'name' => 'phone call log', 
                'module_id' => 2,
            ],[
                'name' => 'admin setup', 
                'module_id' => 2,
            ],[
                'name' => 'student certificate', 
                'module_id' => 2,
            ],[
                'name' => 'general certificate', 
                'module_id' => 2,
            ],[
                'name' => 'student id card', 
                'module_id' => 2,
            ],[
                'name' => 'generate id card ', //11
                'module_id' => 2,
            ],
            [
                'name' => 'Student Admission', // Studnet Information
                'module_id' => 3,
            ],[
                'name' => 'Student list',
                'module_id' => 3,
            ],[
                'name' => 'Student Attendance',
                'module_id' => 3,
            ],[
                'name' => 'Student Attendance Reports',
                'module_id' => 3,
            ],[
                'name' => 'Student Category',
                'module_id' => 3,
            ],[
                'name' => 'Student Group',
                'module_id' => 3,
            ],[
                'name' => 'Student Promote',
                'module_id' => 3,
            ],[
                'name' => 'Disabled Student', // 19
                'module_id' => 3,
            ],
            [
                'name' => 'upload content', // Teacher
                'module_id' => 4,
            ],[
                'name' => 'assignment', 
                'module_id' => 4,
            ],[
                'name' => 'study materials', 
                'module_id' => 4,
            ],[
                'name' => 'syllabus', 
                'module_id' => 4,
            ],[
                'name' => 'others documents', //24
                'module_id' => 4,
            ],
            [
                'name' => 'Collect Fees', // Fees Colection
                'module_id' => 5,
            ],[
                'name' => 'Serach Fees Payment',
                'module_id' => 5, 
            ],[
                'name' => 'Search Fees Due', 
                'module_id' => 5,
            ],[
                'name' => 'Fees Master', 
                'module_id' => 5,
            ],[
                'name' => 'Fees Group',
                'module_id' => 5, 
            ],[
                'name' => 'Fees Type', 
                'module_id' => 5,
            ],[
                'name' => 'Fees Discount', 
                'module_id' => 5,
            ],[
                'name' => 'Fees Carry Forward',  // 32
                'module_id' => 5,
            ],
            [
                'name' => 'profit', // Accounts
                'module_id' => 6,
            ],[
                'name' => 'income', 
                'module_id' => 6,
            ],[
                'name' => 'expense', 
                'module_id' => 6,
            ],[
                'name' => 'search', 
                'module_id' => 6,
            ],[
                'name' => 'chart of account', 
                'module_id' => 6,
            ],[
                'name' => 'payment method', 
                'module_id' => 6,
            ],[
                'name' => 'bank account', // 39
                'module_id' => 6,
            ],
            [
                'name' => 'staff directory', // human resources
                'module_id' => 7,
            ],[
                'name' => 'staff attendance', 
                'module_id' => 7,
            ],[
                'name' => 'staff attendance report', 
                'module_id' => 7,
            ],[
                'name' => 'payrol', 
                'module_id' => 7,
            ],[
                'name' => 'payrol report', 
                'module_id' => 7,
            ],[
                'name' => 'designation', 
                'module_id' => 7,
            ],[
                'name' => 'department', //46
                'module_id' => 7,
            ],
            [
                'name' => 'approve leave request', // Leave Application 
                'module_id' => 8,
            ],[
                'name' => 'apply leave', 
                'module_id' => 8,
            ],[
                'name' => 'leave define', 
                'module_id' => 8,
            ],[
                'name' => 'leave type', // 50
                'module_id' => 8,
            ],
            [
                'name' => 'Exam type' , // Examination 
                'module_id' => 9,
            ],[
                'name' => 'Exam setup', 
                'module_id' => 9,
            ],[
                'name' => 'Exam schedule', 
                'module_id' => 9,
            ],[
                'name' => 'marks register', 
                'module_id' => 9,
            ],[
                'name' => 'exam attendance', 
                'module_id' => 9,
            ],[
                'name' => 'marks grade', 
                'module_id' => 9,
            ],[
                'name' => 'send marks by sms', 
                'module_id' => 9,
            ],[
                'name' => 'online question group', 
                'module_id' => 9,
            ],[
                'name' => 'online question bank', 
                'module_id' => 9,
            ],[
                'name' => 'online exam', // 60
                'module_id' => 9,
            ],
            [
                'name' => 'class routine', // Academics
                'module_id' => 10,
            ],[
                'name' => 'assign subject', 
                'module_id' => 10,
            ],[
                'name' => 'assign class teacher', 
                'module_id' => 10,
            ],[
                'name' => 'subjects', 
                'module_id' => 10,
            ],[
                'name' => 'class', 
                'module_id' => 10,
            ],[
                'name' => 'section', 
                'module_id' => 10,
            ],[
                'name' => 'class room', 
                'module_id' => 10,
            ],[
                'name' => 'cls/exm time setup',  // 68
                'module_id' => 10,
            ],
            [
                'name' => 'add homework', // homework
                'module_id' => 11,
            ],[
                'name' => 'homework list',
                'module_id' => 11,
            ],[
                'name' => 'homework evaluation list', // 71
                'module_id' => 11,
            ],
            [
                'name' => 'notice board', // Communicate
                'module_id' => 12,
            ],[
                'name' => 'send message', 
                'module_id' => 12,
            ],[
                'name' => 'send email/sms', 
                'module_id' => 12,
            ],[
                'name' => 'email/sms logo', 
                'module_id' => 12,
            ],[
                'name' => 'event',  // 76
                'module_id' => 12,
            ],
            [
                'name' => 'Add book', // library
                'module_id' => 13,
            ],[
                'name' => 'book list', 
                'module_id' => 13,
            ],[
                'name' => 'book categories', 
                'module_id' => 13,
            ],[
                'name' => 'add member', 
                'module_id' => 13,
            ],[
                'name' => 'issue/return book', 
                'module_id' => 13,
            ],[
                'name' => 'all issued book', // 82
                'module_id' => 13,
            ],
            [
                'name' => 'item category', // inventory
                'module_id' => 14,
            ],[
                'name' => 'item list', 
                'module_id' => 14,
            ],[
                'name' => 'item store', 
                'module_id' => 14,
            ],[
                'name' => 'supplier', 
                'module_id' => 14,
            ],[
                'name' => 'item receive', 
                'module_id' => 14,
            ],[
                'name' => 'item receive list', 
                'module_id' => 14,
            ],[
                'name' => 'item sell', 
                'module_id' => 14,
            ],[
                'name' => 'item issue', // 90
                'module_id' => 14,
            ],
            [
                'name' => 'routes', // transport
                'module_id' => 15,
            ],[
                'name' => 'vehicle', 
                'module_id' => 15,
            ],[
                'name' => 'assign vehicle', 
                'module_id' => 15,
            ],[
                'name' => 'student transport report', // 94
                'module_id' => 15,
            ],
            [
                'name' => 'dormitory rooms', // dormitory
                'module_id' => 16,
            ],[
                'name' => 'dormitory', 
                'module_id' => 16,
            ],[
                'name' => 'room type', 
                'module_id' => 16,
            ],[
                'name' => 'student dormotory report', //98
                'module_id' => 16,
            ],
            [
                'name' => 'student report', // reports
                'module_id' => 17,
            ],[
                'name' => 'guardian report', 
                'module_id' => 17,
            ],[
                'name' => 'student history', 
                'module_id' => 17,
            ],[
                'name' => 'student login report', 
                'module_id' => 17,
            ],[
                'name' => 'fees statement', 
                'module_id' => 17,
            ],[
                'name' => 'balance fees report', 
                'module_id' => 17,
            ],[
                'name' => 'transaction report', 
                'module_id' => 17,
            ],[
                'name' => 'class report', 
                'module_id' => 17,
            ],[
                'name' => 'class routine', 
                'module_id' => 17,
            ],[
                'name' => 'exam routine', 
                'module_id' => 17,
            ],[
                'name' => 'teacher class routine', 
                'module_id' => 17,
            ],[
                'name' => 'merit list report', 
                'module_id' => 17,
            ],[
                'name' => 'online exam report', 
                'module_id' => 17,
            ],[
                'name' => 'mark sheet report', 
                'module_id' => 17,
            ],[
                'name' => 'tabulation sheet report', 
                'module_id' => 17,
            ],[
                'name' => 'progress card report', 
                'module_id' => 17,
            ],[
                'name' => 'student fine report', 
                'module_id' => 17,
            ],[
                'name' => 'user log', // 116
                'module_id' => 17,
            ],
            [
                'name' => 'general settings', // system settings
                'module_id' => 18,
            ],[
                'name' => 'email settings', 
                'module_id' => 18,
            ],[
                'name' => 'payment method settings', 
                'module_id' => 18,
            ],[
                'name' => 'role permission', 
                'module_id' => 18,
            ],[
                'name' => 'base group', 
                'module_id' => 18,
            ],[
                'name' => 'base setup', 
                'module_id' => 18,
            ],[
                'name' => 'academic year', 
                'module_id' => 18,
            ],[
                'name' => 'session', 
                'module_id' => 18,
            ],[
                'name' => 'holiday', 
                'module_id' => 18,
            ],[
                'name' => 'sms settings', 
                'module_id' => 18,
            ],[
                'name' => 'weekend', 
                'module_id' => 18,
            ],[
                'name' => 'language settings', 
                'module_id' => 18,
            ],[
                'name' => 'backup', 
                'module_id' => 18,
            ],[
                'name' => 'update system', // 130
                'module_id' => 18,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_module_links');
    }
}
