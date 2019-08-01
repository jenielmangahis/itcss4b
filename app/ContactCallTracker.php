<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactCallTracker extends Model
{
	protected $table = 'contact_call_trackers';
    use SoftDeletes;

    public function contact()
    {
    	return $this->belongsTo('App\Contact');
    }    
}
