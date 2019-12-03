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
    const TYPE_MAIL = 4;
    const TYPE_BANK_RUNS = 5;
    const TYPE_UCCS = 6;
    const TYPE_DIRECTION_LETTERS = 7;
    const TYPE_RELEASE_SETTLEMENT = 8;
    const TYPE_SHERIFF_MARSHAL = 9;
    const TYPE_SUMMONS_COMPLAINTS = 10;
    const TYPE_IL_COJ = 11;

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
    		self::TYPE_MISCELLANEOUS => 'Miscellaneous',
            self::TYPE_MAIL => 'Mail',
            self::TYPE_BANK_RUNS => 'Bank Runs',
            self::TYPE_UCCS => 'UCCS',
            self::TYPE_DIRECTION_LETTERS => 'Direciton Letters',
            self::TYPE_RELEASE_SETTLEMENT => 'Release / Settlement',
            self::TYPE_SHERIFF_MARSHAL => 'Sheriff / Marshal',
            self::TYPE_SUMMONS_COMPLAINTS => 'Summons & Complaints',
            self::TYPE_IL_COJ => 'IL/COJ'
    	];

    	return $types;
    }
}
