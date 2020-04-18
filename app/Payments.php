<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $table = 'payments';

    public function user(){
        return $this->belongsTo(User::class, 'id');
    }
}
