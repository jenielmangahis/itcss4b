<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactAdvanceMerchantStatementRecord extends Model
{
	protected $table = 'contact_advance_merchant_statement_records';
    use SoftDeletes;
}
