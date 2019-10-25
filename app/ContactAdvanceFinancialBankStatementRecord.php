<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactAdvanceFinancialBankStatementRecord extends Model
{
	protected $table = 'contact_advance_financial_bank_statement_records';
    use SoftDeletes;
}
