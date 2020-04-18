<?php

namespace App\Http\Controllers;
use App\Repositories\Category\CategoryInterface;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    protected $category;
    public function __construct(CategoryInterface $category){
        $this->category = $category;
}
    public function index(){
        $categories = $this->category->all();
        return view('home.index', compact('categories'));
    }
}
