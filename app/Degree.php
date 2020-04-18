<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    protected $table = 'degree';

    public function degree_programme () {
        return $this->hasMany(DegreeProgramme::class, 'degree_id');
    }

//    public function programmes () {
//        return $this->hasMany(DegreeProgramme::class, 'degree_id');
//    }
}
