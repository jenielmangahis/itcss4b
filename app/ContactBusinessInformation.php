<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactBusinessInformation extends Model
{
    //protected $table = 'contact_business_informations';
    use SoftDeletes;
}
