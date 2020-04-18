<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Projects\ProjectInterface;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\SubCategory\SubCategoryInterface;
use Illuminate\Http\Request;
use Jleon\LaravelPnotify\Notify;

class ProjectController extends Controller
{
    protected $project;
    protected $category;
    protected $subCategory;

    public function __construct(
        ProjectInterface $project,
        CategoryInterface $category,
        SubCategoryInterface $subCategory
    ){
        $this->project          = $project;
        $this->category         = $category;
        $this->subCategory      = $subCategory;
    }

    public function addProjectPost(Request $request){
        $data = $request->all();
        if ($files = $request->file('file')) {
            $data['files'] = $files;
        }else{
            $data['files'] = null;
        }
        $project = $this->project->add($data);

        return json_encode($project);
    }

    public function getUserTasks() {
        $userId = Auth::id();
        $projects = Array();
        $categories = $this->category->all();

        $activeprojects = $this->project->getProjectsByUserId($userId);
        $completedProjects = $this->project->getCompletedProjectsByUserId($userId);
        $discardedProjects = $this->project->getDiscardedProjectsByUserId($userId);
        
        $projects['active_projects'] = $activeprojects['projects'];
        $projects['completed_projects'] = $completedProjects['projects'];
        $projects['discarded_projects'] = $discardedProjects['projects']; 
        
        return view('user.tasks', compact('projects', 'categories'));
    }

    public function getTaskById($id){
        $project = $this->project->get($id);
        $category = $this->category->get($project['cat_id']);
        $subCategory = $this->subCategory->get($project['sub_cat_id']);
        $allSubCategories = $this->category->get($project['cat_id'])->sub_categories;
        $project['category'] = $category['name'];
        $project['sub_category'] = $subCategory['name'];
        $project['all_sub_categories'] = $allSubCategories;
        return json_encode($project);
    }

    public function editProjectPost(Request $request){
        $data = $request->all();
        if ($files = $request->file('file')) {
            $data['files'] = $files;
        }else{
            $data['files'] = null;
        }
        $project = $this->project->update($data);
        return json_encode($project);
    }

    public function deleteProject(Request $request){
        $data = $request->all();
        $project = $this->project->markDiscarded($data['id']);
        if ($project['isSuccess'] === true){
            Notify::success($project['message']);
        }else{
            Notify::error($project['message']);
        }
        return redirect()->back();
    }

    public function completeProject(Request $request){
        $data = $request->all();
        $project = $this->project->markComplete($data['id']);
        if ($project['isSuccess'] === true){
            Notify::success($project['message']);
        }else{
            Notify::error($project['message']);
        }
        return redirect()->back();
    }
}
