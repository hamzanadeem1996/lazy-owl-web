<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bids extends Model
{
    protected $table = 'bids';

    public function user(){
        return $this->hasOne( User::class, 'id');
    }
}
