<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    public function sub_categories () {
        return $this->hasMany(SubCategory::class, 'cat_id');
    }

    public function user_service_category(){
        return $this->belongsTo( UserServices::class, 'cat_id');
    }

    public function user_experience_category(){
        return $this->belongsTo( UserExperience::class, 'cat_id');
    }

    public function project_category(){
        return $this->belongsTo( Projects::class, 'cat_id');
    }
}
