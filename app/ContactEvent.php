<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactEvent extends Model
{
    protected $table = 'contact_events';
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo('App\User');
    }    
}
