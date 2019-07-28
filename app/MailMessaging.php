<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MailMessaging extends Model
{
    protected $table = 'mail_messaging';
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }
}
