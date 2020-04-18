<?php

namespace App\Http\Controllers;
use App\Repositories\SubCategory\SubCategoryInterface;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    protected $subCategory;

    public function __construct(
        SubCategoryInterface $subCategory
    ){
        $this->subCategory = $subCategory;
    }
    public function getAllSubCategories(){
        $categories = $this->subCategory->all();
        return json_encode($categories);
    }
}
