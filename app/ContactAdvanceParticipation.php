<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactAdvanceParticipation extends Model
{
    protected $table = 'contact_advance_participation';
    use SoftDeletes;

    public function lender()
    {
    	return $this->belongsTo('App\Lender');
    }
}
