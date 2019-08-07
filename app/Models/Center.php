<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    //
    protected $fillable = [
        'center_name','address','maximum_nomination','deleted'
    ];

      //relationship between center and centermanager one to one
      public function user(){

        return $this->hasOne('App\User','center_id','id');

    }

     //relationship between center and employee one to many
     public function employee(){

        return $this->hasMany('App\Models\Employee','center_id','old_center_id','id');

    }
}
