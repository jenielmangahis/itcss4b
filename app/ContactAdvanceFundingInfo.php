<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactAdvanceFundingInfo extends Model
{
	protected $table = 'contact_advance_funding_info';
    use SoftDeletes;

    public function contact_advance()
    {
        return $this->belongsTo('App\ContactAdvance');
    }  
}
