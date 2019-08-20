<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactTask extends Model
{
    //protected $table = 'contact_tasks';
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo('App\User');
    }           
}
