<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPortfolio extends Model
{
    protected $table = 'user_portfolio';

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
