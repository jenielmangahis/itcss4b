<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactAdvance extends Model
{
    protected $table = 'contact_advances';
    use SoftDeletes;
}
