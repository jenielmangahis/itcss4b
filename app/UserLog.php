<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserLog extends Model
{
    protected $table = 'user_logs';
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo('App\User');
    }      
}
