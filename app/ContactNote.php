<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactNote extends Model
{
	protected $table = 'contact_notes';
    use SoftDeletes;
}
