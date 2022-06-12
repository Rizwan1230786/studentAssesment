<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\SmGeneralSettings;
class CreateSmGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_general_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('school_name')           ->nullable();
            $table->string('site_title')            ->nullable();
            $table->string('school_code')           ->nullable();
            $table->string('address')               ->nullable();
            $table->string('phone')                 ->nullable();
            $table->string('email')                 ->nullable();
            $table->integer('session_id')           ->nullable()->default(1);
            $table->integer('language_id')          ->nullable()->default(1);
            $table->integer('date_format_id')       ->nullable()->default(1);
            $table->string('currency')              ->nullable()->default('USD');
            $table->string('currency_symbol')       ->nullable()->default('$');
            $table->string('logo')                  ->nullable(); 
            $table->string('favicon')               ->nullable(); 
            $table->string('system_version')        ->nullable()->default('1.0');
            $table->integer('active_status')        ->nullable()->default(1);
            $table->string('currency_code')         ->nullable()->default('USD');
            $table->string('language_name')         ->nullable()->default('en');
            $table->string('session_year')          ->nullable()->default('2019');
            $table->string('system_purchase_code')  ->nullable();
            $table->date('system_activated_date')   ->nullable();
            $table->string('envato_user')           ->nullable();
            $table->string('envato_item_id')        ->nullable();

            $table->string('system_domain')         ->nullable();
            $table->string('copyright_text')        ->nullable();
            $table->timestamps();
        });

 
        


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_general_settings');
    }
}
