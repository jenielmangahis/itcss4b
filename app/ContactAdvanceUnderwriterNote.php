<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactAdvanceUnderwriterNote extends Model
{
	protected $table = 'contact_advance_underwriter_notes';
    use SoftDeletes;

    public function company()
    {
        return $this->belongsTo('App\Companies');
    }      
}
