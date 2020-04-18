<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserQualification extends Model
{
    protected $table = 'user_qualifications';

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function degree(){
        return $this->hasOne( Degree::class, 'id', 'degree_id');
    }

    public function programme(){
        return $this->hasOne( DegreeProgramme::class, 'id', 'programme_id');
    }
}
