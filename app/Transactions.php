<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $table = 'transactions';

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function toUser(){
        return $this->belongsTo(User::class, 'to_user_id');
    }

    public function project(){
        return $this->belongsTo(Projects::class, 'project_id');
    }
}
