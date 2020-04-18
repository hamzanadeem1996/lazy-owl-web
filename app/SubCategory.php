<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'sub_category';

    public function category(){
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function user_service_sub_category() {
        return $this->belongsTo(UserServices::class, 'sub_cat_id');
    }

    public function user_experience_sub_category() {
        return $this->belongsTo(UserExperience::class, 'sub_cat_id');
    }
}
