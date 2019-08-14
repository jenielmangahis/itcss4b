<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactNote extends Model
{
	protected $table = 'contact_notes';
    use SoftDeletes;

    public function note_type()
    {
        return $this->belongsTo('App\NoteType');
    }      

    public function notify_user()
    {
        return $this->belongsTo('App\User');
    }      
}
