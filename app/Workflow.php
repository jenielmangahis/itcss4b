<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workflow extends Model
{
    use SoftDeletes;

    public function workflow_category()
    {
        return $this->belongsTo('App\WorkflowCategory');
    }  

    public function stage()
    {
        return $this->belongsTo('App\Stage');
    }
}
