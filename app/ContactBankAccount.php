<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactBankAccount extends Model
{
    use SoftDeletes;

    public function state()
    {
        return $this->belongsTo('App\State');
    }  

    public function optionsAccountTypes()
    {
    	$options = [
    		'Checking Account' => 'Checking Account',
    		'Savings Account' => 'Savings Account',
    		'Certificate of Deposit' => 'Certificate of Deposit',
    		'Money Market account' => 'Money Market Account',
    		'Individual Retirement Accounts (IRAs)' => 'Individual Retirement Accounts (IRAs)'
    	];

    	return $options;
    }
}
