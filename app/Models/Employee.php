<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $fillable = [
        'candidate','job','employee_name','employee_identity','mobile','email','center_id','old_center_id','deleted',
    ];

     //relationship between employee and center many to one
     public function center(){

        return $this->belongsTo('App\Models\Center','old_center_id');

    }

    public function center1(){

        return $this->belongsTo('App\Models\Center','center_id');

    }

     //relationship between employee and attendance one to many
     public function attendance(){

        return $this->hasMany('App\Models\Attendance','employee_id','id');

    }
}
