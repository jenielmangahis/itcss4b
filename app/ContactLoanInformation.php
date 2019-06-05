<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactLoanInformation extends Model
{
    //protected $table = 'contact_loan_informations';
    use SoftDeletes;
}
