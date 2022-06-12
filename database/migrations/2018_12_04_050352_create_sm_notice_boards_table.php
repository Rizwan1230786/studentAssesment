<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmNoticeBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_notice_boards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('notice_title',100)->nullable();
            $table->text('notice_message')->nullable();
            $table->date('notice_date')->nullable();
            $table->date('publish_on')->nullable();
            $table->string('inform_to',100)->nullable()->comment('Notice message sent to these roles');
            $table->tinyInteger('active_status')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
        DB::table('sm_notice_boards')->insert([
            [
                'notice_title' => 'Inter school football tournament',
                'notice_message' => 'Sit eget Vivamus pede etiam purus. A arcu Consequat feugiat etiam egestas, quis amet nec dictumst sociosqu integer mattis euismod.',
                'notice_date' => '2019-06-11',
                'publish_on' => '2019-06-12',
                'inform_to' => '2,3,9',
            ],
            [
                'notice_title' => 'Seminar On ICT',
                'notice_message' => 'Tellus luctus. Mattis phasellus venenatis ante porttitor purus. Scelerisque justo aenean lectus, adipiscing. Hymenaeos nulla metus eu auctor pharetra, risus lacus amet posuere quisque et Vehicula posuere nibh diam sociis accumsan varius vehicula inceptos duis,',
                'notice_date' => '2019-06-10',
                'publish_on' => '2019-06-11',
                'inform_to' => '2,3',
            ],
            [
                'notice_title' => 'Internet of Things Competition',
                'notice_message' => 'Adipiscing sociosqu quis pede diam natoque aenean, sociosqu lacinia vel magna. Nostra ornare, velit ultrices venenatis. Tellus est velit laoreet lectus dui nibh lorem erat aptent a porttitor torquent urna varius class aenean sapien.',
                'notice_date' => '2019-06-10',
                'publish_on' => '2019-06-11',
                'inform_to' => '2,3',
            ],
            [
                'notice_title' => 'Cricket Match Between Class Ten with Nine',
                'notice_message' => 'Dignissim sodales praesent gravida eros facilisi nec. Lacinia habitasse accumsan suspendisse. Porta praesent eu natoque, nibh scelerisque per urna torquent nisl praesent. Cum Accumsan nibh platea donec tempus.',
                'notice_date' => '2019-06-10',
                'publish_on' => '2019-06-11',
                'inform_to' => '2,3',
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
        Schema::dropIfExists('sm_notice_boards');
    }
}
