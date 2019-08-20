<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactDocs extends Model
{
    use SoftDeletes;

    const TYPE_GENERAL = 1;
    const TYPE_CONTRACT = 2;
    const TYPE_MISCELLANEOUS = 3;

    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function documentTypes()
    {
    	$types = [
    		self::TYPE_GENERAL => 'General',
    		self::TYPE_CONTRACT => 'Contract',
    		self::TYPE_MISCELLANEOUS => 'Miscellaneous'
    	];

    	return $types;
    }
}
