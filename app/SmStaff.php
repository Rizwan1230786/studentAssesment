<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmStaff extends Model
{
    public function roles(){
		return $this->belongsTo('App\Role', 'role_id', 'id');
	}

	public function departments(){
		return $this->belongsTo('App\SmHumanDepartment', 'department_id', 'id');
	}

	public function designations(){
		return $this->belongsTo('App\SmDesignation', 'designation_id', 'id');
	}

	public function genders(){
		return $this->belongsTo('App\SmBaseSetup', 'gender_id', 'id');
	}


}
