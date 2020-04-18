<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Projects\ProjectInterface;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\SubCategory\SubCategoryInterface;
use App\Repositories\User\UserInterface;
use App\Repositories\Wallet\WalletInterface;
use Illuminate\Http\Request;
use Jleon\LaravelPnotify\Notify;

class ProjectController extends Controller
{
    protected $project;
    protected $category;
    protected $subCategory;
    protected $user;
    protected $wallet;

    public function __construct(
        ProjectInterface        $project,
        CategoryInterface       $category,
        SubCategoryInterface    $subCategory,
        UserInterface           $user,
        WalletInterface         $wallet
    ){
        $this->project          = $project;
        $this->category         = $category;
        $this->subCategory      = $subCategory;
        $this->user             = $user;
        $this->wallet           = $wallet;
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
        
        if($project['assigned_to'] !== null){
            $user = $this->user->get($project['assigned_to']);
            $project['assigned_to_user'] = $user['name'];
            $project['assigned_to_user_url'] = env('APP_URL')."/active/task/bidder/".$user['id'];
        } 
        
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

        $projectDetails = $this->project->get($data['id']);
        $budget = $projectDetails['budget'];
        $userWalletBalance = null;
        
        if (Auth::user()->wallet){
            $userWalletBalance = Auth::user()->wallet->amount;
            if ($userWalletBalance > $budget){
                $data['amount'] = $budget;
                $data['user_id'] = Auth::id();
                $deductAmount = $this->wallet->minus($data);

                if ($deductAmount['isSuccess'] ==  true){
                    $taskFee = $budget / 100 * env('PERCENTAGE_PER_TASK');
                    $amountToTransfer = $budget - $taskFee;

                    $transferData['amount'] = $amountToTransfer;
                    $transferData['user_id'] = $projectDetails['assigned_to'];
                    $transferAmount = $this->wallet->add($transferData);

                    if ($transferAmount['isSuccess'] == true){
                        $project = $this->project->markComplete($data['id']);
                        if ($project['isSuccess'] === true){
                            Notify::success($project['message']);
                        }else{
                            Notify::error($project['message']);
                        }
                    }else{
                        Notify::error($transferAmount['message']);
                    }
                }else{
                    Notify::error($deductAmount['message']);
                }
            }else{
                $message = "You don't have enough wallet balance to pay for this task. Please deposit some amount to your wallet to proceed";
                Notify::error($message);
            }
        }else{
            $message = "You don't have enough wallet balance to pay for this task. Please deposit some amount to your wallet to proceed";
            Notify::error($message);
        }
    
        return redirect()->back();
    }
}
