<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactCreditCard extends Model
{
    use SoftDeletes;

    public function optionsCardTypes()
    {
    	$options = [
    		'American Express' => 'American Express',
    		'Discover' => 'Discover',
    		'MasterCard' => 'MasterCard',
    		'Visa' => 'Visa'
    	];

    	return $options;
    }

    public function optionsDebitCredit()
    {
    	$options = [
    		'Credit Card' => 'Credit Card',
    		'Debit Card' => 'Debit Card'
    	];

    	return $options;
    }
}
