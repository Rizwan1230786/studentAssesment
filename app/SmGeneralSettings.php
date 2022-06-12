<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use App\SmLanguage;

class SmGeneralSettings extends Model
{
    public function sessions(){
    	return $this->belongsTo('App\SmSession', 'session_id', 'id');
    }

    public function languages(){
    	return $this->belongsTo('App\SmLanguage', 'language_id', 'id');
    }

    public function dateFormats(){
    	return $this->belongsTo('App\SmDateFormat', 'date_format_id', 'id');
    }
    public static function getLanguageList(){
    	$languages = SmLanguage::all();
    	return $languages;
    }

    public static function value(){
        $value = SmGeneralSettings::first();
        return $value->system_purchase_code;
    }

}
