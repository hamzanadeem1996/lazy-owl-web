<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $table = 'projects';

    public function category() {
        return $this->hasOne(Category::class, 'id', 'cat_id');
    }

    public function projectQueries(){
        return $this->hasMany(ProjectQueries::class, 'project_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transactions(){
        return $this->hasMany(Transactions::class, 'project_id');
    }
}
