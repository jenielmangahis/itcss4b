<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyUser extends Model
{
    use SoftDeletes;

    public function company()
    {
        return $this->belongsTo('App\Companies');
    }  

    public function user()
    {
        return $this->belongsTo('App\User');
    }          
}
