<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //
    protected $fillable = [
        'employee_id','date','delay_hour','delay_minute',
    ];

     //relationship between employee and attendance one to many
     public function employee(){

        return $this->belongsTo('App\Models\Employee','employee_id');

    }
}
