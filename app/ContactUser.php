<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUser extends Model
{
    protected $table = 'contact_users';
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo('App\User');
    }  

    public function contact_id()
    {
        return $this->belongsTo('App\Contact');
    }  
}
