<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmAboutPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_about_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('main_title')->nullable();
            $table->text('main_description')->nullable();
            $table->string('image')->nullable();
            $table->string('main_image')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->string('created_by')->default(1)->nullable();
            $table->string('updated_by')->default(1)->nullable();
        });
        DB::table('sm_about_pages')->insert([
            [
                'title' => 'About Infix',
                'description' => 'Lisus consequat sapien metus dis urna, facilisi. Nonummy rutrum eu lacinia platea a, ipsum parturient, orci tristique. Nisi diam natoque.',
                'image' => 'public/uploads/about_page/about.jpg',
                'button_text' => 'Learn More About Us',
                'button_url' => 'about',
                'main_title'=>'Under Graduate Education',
                'main_description'=>'Tellus vitae adipiscing quisque a, risus consequat sapien metus dis urna, facilisi. Nonummy rutrum eu lacinia platea a, ipsum parturient, orci tristique. Nisi diam natoque, enim taciti imperdiet tristique justo orci penatibus varius vivamus hac lacinia sollicitudin habitasse Non. Blandit ridiculus sem nibh nibh duis libero aenean vehicula rhoncus faucibus magnis pellentesque velit ridiculus. Molestie. Vitae per magna leo sociis vel nec a viverra, habitasse. Nisl lorem urna nulla. Ultricies. Sollicitudin nullam blandit ultricies penatibus dui cum accumsan nostra a, adipiscing augue mauris. Class magnis a quis nunc nisl. Cubilia dignissim eros primis tristique tristique. Cubilia. Malesuada. Varius donec diam.',
                'main_image'=>'public/uploads/about_page/about-img.jpg',
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
        Schema::dropIfExists('sm_about_pages');
    }
}
