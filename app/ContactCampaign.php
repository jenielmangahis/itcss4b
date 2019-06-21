<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactCampaign extends Model
{
	protected $table = 'contact_campaigns';
    use SoftDeletes;

    public function company()
    {
        return $this->belongsTo('App\Companies');
    }    
    
    public function media_type()
    {
        return $this->belongsTo('App\MediaType');
    }         
}
