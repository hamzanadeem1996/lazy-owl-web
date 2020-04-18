<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserServices extends Model
{
    protected $table = 'user_services';

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(){
        return $this->hasOne( Category::class, 'id', 'cat_id');
    }

    public function sub_category() {
        return $this->hasOne(SubCategory::class, 'id','sub_cat_id');
    }
}
