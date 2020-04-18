<?php
namespace App\Repositories\Category;
use App\Category;

class CategoryRepository implements CategoryInterface {

    public function add($data)
    {
        $check = Category::where('name', $data['name'])->get();
        if (count($check) > 0 ){
            return $result = array(
                'isSuccess' => false,
                'message' => 'Category already exists'
            );
        }else{
            $category = new Category();
            $category->name = $data['name'];
            if ($data['files'] != null) {
                $files = $data['files'];
                $destinationPath = 'images/category/';
                $categoryImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $categoryImage);
                $data['image'] = "$categoryImage";
                $category->image = $data['image'];
            }
            if ($category->save()){
                return $result = array(
                    'isSuccess' => true,
                    'message' => 'Category added successfully'
                );
            }else{
                return $result = array(
                    'isSuccess' => false,
                    'message' => 'Internal Server Error'
                );
            }
        }
    }

    public function update($data)
    {
        $category = Category::find($data['id']);
        if (isset($category) > 0) {
            $category->name = $data['name'];
            if (isset($data['files'])) {
                $files = $data['files'];
                $destinationPath = 'images/category/';
                $categoryImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $categoryImage);
                $data['image'] = "$categoryImage";
                $category->image = $data['image'];
            }else{
                $category->image = $data['default_image'];
            }
        }else{
            return $result = array(
                'isSuccess' => false,
                'message' => 'Category does not exists'
            );
        }
        if ($category->save()){
            return $result = array(
                'isSuccess' => true,
                'message' => 'Category updated successfully'
            );
        }else{
            return $result = array(
                'isSuccess' => false,
                'message' => 'Internal Server Error'
            );
        }
    }

    public function get($id)
    {
        return $category = Category::find($id);
    }

    public function delete($id)
    {
        $category = Category::find($id);
        if ($category->status == 1){
            $category->status = 0;
            if ($category->save()){
                return $result = array(
                    'isSuccess' => true,
                    'message' => 'Category disabled successfully'
                );
            }else{
                return $result = array(
                    'isSuccess' => false,
                    'message' => 'Internal Server Error'
                );
            }
        }else{
            $category->status = 1;
            if ($category->save()){
                return $result = array(
                    'isSuccess' => true,
                    'message' => 'Category enabled successfully'
                );
            }else{
                return $result = array(
                    'isSuccess' => false,
                    'message' => 'Internal Server Error'
                );
            }
        }
    }

    public function all()
    {
        return $categories = Category::where('status', 1)->get();
    }

    public function disabled()
    {
        return $categories = Category::where('status', 0)->get();
    }
}
