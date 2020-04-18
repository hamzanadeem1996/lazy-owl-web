<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DegreeProgramme extends Model
{
    protected $table = 'degree_programme';

    public function degree() {
        return $this->belongsTo(Degree::class, 'degree_id');
    }
}
