<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactHistory extends Model
{
    protected $table = 'contact_history';
    use SoftDeletes;
}
