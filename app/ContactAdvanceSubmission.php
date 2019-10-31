<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactAdvanceSubmission extends Model
{
	protected $table = 'contact_advance_submissions';
    use SoftDeletes;

    public function contact_advance()
    {
        return $this->belongsTo('App\ContactAdvance');
    }  
}
