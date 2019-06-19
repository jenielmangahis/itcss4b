<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactDatasource extends Model
{
    protected $table = 'contact_datasource';
    use SoftDeletes;
}
