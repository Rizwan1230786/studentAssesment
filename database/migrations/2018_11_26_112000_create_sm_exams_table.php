<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_exams', function (Blueprint $table) {
            $table->increments('id'); 

            $table->bigInteger('exam_type_id')->default(1);
            $table->integer('school_id')->nullable()->default(1);
            $table->bigInteger('class_id')->nullable()->default(1);
            $table->bigInteger('section_id')->nullable()->default(1);
            $table->bigInteger('subject_id')->nullable()->default(1); 
            $table->float('exam_mark')->nullable(); 
            $table->tinyInteger('active_status')->default(1);
            $table->string('created_by')->nullable()->default(1);
            $table->string('updated_by')->nullable()->default(1);
            $table->timestamps();
        });
        $sql ="INSERT INTO `sm_exams` (`id`, `exam_type_id`, `school_id`, `class_id`, `section_id`, `subject_id`, `exam_mark`, `active_status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 100.00, 1, '1', '1', '2019-05-31 08:26:57', '2019-05-31 08:26:57'),
(2, 1, 1, 1, 1, 2, 100.00, 1, '1', '1', '2019-05-31 08:26:57', '2019-05-31 08:26:57'),
(3, 1, 1, 1, 1, 3, 100.00, 1, '1', '1', '2019-05-31 08:26:58', '2019-05-31 08:26:58'),
(4, 1, 1, 1, 2, 1, 100.00, 1, '1', '1', '2019-05-31 08:26:58', '2019-05-31 08:26:58'),
(5, 1, 1, 1, 2, 2, 100.00, 1, '1', '1', '2019-05-31 08:26:58', '2019-05-31 08:26:58'),
(6, 1, 1, 1, 2, 3, 100.00, 1, '1', '1', '2019-05-31 08:26:58', '2019-05-31 08:26:58'),
(7, 1, 1, 1, 3, 1, 100.00, 1, '1', '1', '2019-05-31 08:26:58', '2019-05-31 08:26:58'),
(8, 1, 1, 1, 3, 2, 100.00, 1, '1', '1', '2019-05-31 08:26:58', '2019-05-31 08:26:58'),
(9, 1, 1, 1, 3, 3, 100.00, 1, '1', '1', '2019-05-31 08:26:58', '2019-05-31 08:26:58')";
        DB::insert($sql);

        // DB::table('sm_exams')->insert([
        //     [
        //         'exam_type_id' => 1,
        //         'school_id' => 1,
        //         'class_id' => 1,
        //         'section_id' => 1,
        //         'subject_id' => 1,
        //         'exam_mark' => '100',
                
        //         'active_status' => 1,

        //     ],
        //     [
        //         'exam_type_id' => 2,
        //         'school_id' => 1,
        //         'class_id' => 1,
        //         'section_id' => 1,
        //         'subject_id' => 1,
        //         'exam_mark' => '100',
        //         'active_status' => 1,

        //     ],
        //     [
        //         'exam_type_id' => 3,
        //         'school_id' => 1,
        //         'class_id' => 1,
        //         'section_id' => 1,
        //         'subject_id' => 1,
        //         'exam_mark' => '100',
        //         'active_status' => 1,

        //     ]
        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_exams');
    }
}
