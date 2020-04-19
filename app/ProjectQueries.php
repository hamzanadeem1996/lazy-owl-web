<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectQueries extends Model
{
    protected $table = 'project_queries';

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function project(){
        return $this->belongsTo(Projects::class, 'project_id');
    }
}
