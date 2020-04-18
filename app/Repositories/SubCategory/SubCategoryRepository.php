<?php
namespace App\Repositories\SubCategory;
use App\SubCategory;

class SubCategoryRepository implements SubCategoryInterface {

    public function add($data)
    {
        $check = SubCategory::where('name', $data['name'])->where('cat_id', $data['cat_id'])->get();
        if (count($check) > 0 ){
            return $result = array(
                'isSuccess' => false,
                'message' => 'Sub Category already exists'
            );
        }else{
            $category = new SubCategory();
            $category->name = $data['name'];
            $category->cat_id = $data['cat_id'];
            if ($category->save()){
                return $result = array(
                    'isSuccess' => true,
                    'message' => 'Sub Category added successfully'
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
        $category = SubCategory::find($data['id']);
        if (isset($category) > 0) {
            $category->name = $data['name'];
            $category->cat_id = $data['cat_id'];
        }else{
            return $result = array(
                'isSuccess' => false,
                'message' => 'Sub Category does not exists'
            );
        }
        if ($category->save()){
            return $result = array(
                'isSuccess' => true,
                'message' => 'Sub Category updated successfully'
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
        return $category = SubCategory::find($id);
    }

    public function delete($id)
    {
        $category = SubCategory::find($id);
        if ($category->status == 1){
            $category->status = 0;
            if ($category->save()){
                return $result = array(
                    'isSuccess' => true,
                    'message' => 'Sub Category disabled successfully'
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
                    'message' => 'Sub Category enabled successfully'
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
        return $categories = SubCategory::where('status', 1)->get();
    }

    public function disabled()
    {
        return $categories = SubCategory::where('status', 0)->get();
    }
}
