<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LenderContact extends Model
{
	//protected $table = 'lender_contacts';
    use SoftDeletes;
}
