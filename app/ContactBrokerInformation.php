<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactBrokerInformation extends Model
{
    //protected $table = 'contact_broker_informations';
    use SoftDeletes;
}
