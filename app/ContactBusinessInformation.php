<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactBusinessInformation extends Model
{
    protected $table = 'contact_business_informations';
    use SoftDeletes;

    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }

    public function company()
    {
        return $this->belongsTo('App\Companies');
    }
}
