<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmTeacherUploadContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_teacher_upload_contents', function (Blueprint $table) {
        $table->increments('id');
        $table->string('content_title')->length(100)->nullable();
        $table->string('content_type')->nullable()->comment("as assignment, st study material, sy sullabus, ot others download");
        $table->tinyInteger('available_for_admin')->default(0);
        $table->tinyInteger('available_for_all_classes')->default(0);
        $table->tinyInteger('class')->nullable();
        $table->tinyInteger('section')->nullable();
        $table->date('upload_date')->nullable();
        $table->string('description')->length(500)->nullable();
        $table->string('upload_file')->length(200)->nullable();
        $table->tinyInteger('active_status')->default(1);
        $table->integer('created_by')->nullable();
        $table->integer('updated_by')->nullable();
        $table->timestamps();
    });
        DB::table('sm_teacher_upload_contents')->insert([
            [
                'content_title' => 'Demo Content',
                'content_type' => 'as',
                'available_for_admin'=>'1',
                'available_for_all_classes'=>'0',
                'class'=>null,
                'section'=>null,
                'upload_date'=>'2019-05-30',
                'description'=>'Libero senectus sem etiam consectetuer. Nam feugiat primis pharetra senectus potenti hac lacus eros. Sociosqu sem laoreet litora risus tristique montes. Ultricies habitasse penatibus lobortis fusce cras, pretium ullamcorper placerat.',
                'upload_file'=>'public/uploads/upload_contents/demo.png',
                'active_status'=>'1',
                'created_by'=>'1'

            ],
            [
                'content_title' => 'Dummy Content',
                'content_type' => 'st',
                'available_for_admin'=>'0',
                'available_for_all_classes'=>'1',
                'class'=>null,
                'section'=>null,
                'upload_date'=>'2019-05-30',
                'description'=>'Litora imperdiet consectetuer natoque dapibus. Dapibus integer ut porta habitasse at fermentum vitae senectus nisi nibh primis id Per orci.',
                'upload_file'=>'public/uploads/upload_contents/demo.png',
                'active_status'=>'1',
                'created_by'=>'1'

            ],
            [
                'content_title' => 'Sample Content',
                'content_type' => 'st',
                'available_for_admin'=>'0',
                'available_for_all_classes'=>'0',
                'class'=>'1',
                'section'=>'1',
                'upload_date'=>'2019-05-30',
                'description'=>'Litora imperdiet consectetuer natoque dapibus. Dapibus integer ut porta habitasse at fermentum vitae senectus nisi nibh primis id Per orci.',
                'upload_file'=>'public/uploads/upload_contents/demo.png',
                'active_status'=>'1',
                'created_by'=>'1'
            ],

        ]);

       //  Schema::table('sm_teacher_upload_contents', function($table) {
       //      $table->foreign('available_for')->references('id')->on('roles');
       //      $table->foreign('available_for_class_id')->references('id')->on('sm_classes');
       //      $table->foreign('available_for_section_id')->references('id')->on('sm_sections');
           
       // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_teacher_upload_contents');
    }
}
