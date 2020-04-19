<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Repositories\User\UserInterface;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\SubCategory\SubCategoryInterface;
use App\Repositories\Projects\ProjectInterface;

class HomeController extends Controller
{
    protected $authentication;
    protected $category;
    protected $subCategory;
    protected $project;
    protected $user;

    public function __construct(
        // AuthenticationRepositoryInterface $authentication,
        CategoryInterface $category,
        SubCategoryInterface $subCategory,
        ProjectInterface $project,
        UserInterface $user
    ){
        // $this->authentication  = $authentication;
        $this->category        = $category;
        $this->subCategory     = $subCategory;
        $this->project         = $project;
        $this->user            = $user;
    }

    public function checkUserRole(){
        if (Auth::user()){
            $roleID = Auth::user()->role;
//        Role ID 1 for admin, 2 for service seeker, 3 for service provider and 4 for consultant.
            if ($roleID === 1){
                return redirect('/admin');
            }elseif ($roleID === 2){
                return redirect('/user');
            }elseif ($roleID === 3){
                return redirect('/user');
            }elseif ($roleID === 4){
                return redirect('/user');
            }
        }else{
            redirect('/login');
        }

    }

    public function loadOnboardingPage(){
        return view('auth.onboard');
    }

    public function getActiveTasks(){
        $userId = Auth::id();
        $projects = $this->project->getUnAssignedProjects();
        return view('home.tasks.active_tasks', compact('projects'));
    }

    public function getTaskByid($id){
        $project = $this->project->get($id);
        $category = $this->category->get($project['cat_id']);
        $subCategory = $this->subCategory->get($project['sub_cat_id']);
        $user = $this->user->get($project['user_id']);
        $project['category'] = $category['name'];
        $project['sub_category'] = $subCategory['name'];
        $project['posted_by'] = $user['name'];
        $project['posted_by_id'] = $user['id']; 
        return view('home.tasks.task_details', compact('project'));
    }

    public function getUserProfileById($id){
        $user = $this->user->get($id);
        $tasksCount = $this->project->getUserProjectsCount($id);
        $user['tasks_count'] = $tasksCount;
        return view('home.user_profile', compact('user'));
    }
}
