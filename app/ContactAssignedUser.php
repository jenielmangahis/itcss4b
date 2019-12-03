<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactAssignedUser extends Model
{
	protected $table = 'contact_assigned_users';
    use SoftDeletes;

    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }  

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
