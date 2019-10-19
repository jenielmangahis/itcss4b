<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactAdvancePayment extends Model
{
    protected $table = 'contact_advance_payments';
    use SoftDeletes;

    public function payee()
    {
    	return $this->belongsTo('App\User');
    }       
}
