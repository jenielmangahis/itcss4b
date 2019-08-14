<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NoteType extends Model
{
	//protected $table = 'note_types';
    use SoftDeletes;
}
