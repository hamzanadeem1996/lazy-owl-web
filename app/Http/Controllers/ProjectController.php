<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Projects\ProjectInterface;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\SubCategory\SubCategoryInterface;
use App\Repositories\User\UserInterface;
use App\Repositories\Wallet\WalletInterface;
use App\Repositories\Transactions\TransactionsInterface;
use Illuminate\Http\Request;
use Jleon\LaravelPnotify\Notify;

class ProjectController extends Controller
{
    protected $project;
    protected $category;
    protected $subCategory;
    protected $user;
    protected $wallet;
    protected $transaction;

    public function __construct(
        ProjectInterface        $project,
        CategoryInterface       $category,
        SubCategoryInterface    $subCategory,
        UserInterface           $user,
        WalletInterface         $wallet,
        TransactionsInterface    $transaction
    ){
        $this->project          = $project;
        $this->category         = $category;
        $this->subCategory      = $subCategory;
        $this->user             = $user;
        $this->wallet           = $wallet;
        $this->transaction      = $transaction;
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
        $projects = null;
        $categories = $this->category->all();

        if (Auth::user()->role != 4){
            $userRole = Auth::user()->role;
            $activeprojects = $this->project->getProjectsByUserId($userId, $userRole);
            $completedProjects = $this->project->getCompletedProjectsByUserId($userId, $userRole);
            $discardedProjects = $this->project->getDiscardedProjectsByUserId($userId, $userRole);
            $projects = Array();
            $projects['active_projects'] = $activeprojects['projects'];
            $projects['completed_projects'] = $completedProjects['projects'];
            $projects['discarded_projects'] = $discardedProjects['projects']; 
        }else{
            $projects = $this->project->getConsultantProjects($userId);
        }
        // return $projects;   
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
                
                $transactionData = array();
                $transactionData['user_id'] = $projectDetails['user_id'];
                $transactionData['to_user_id'] = $projectDetails['assigned_to'];
                $transactionData['project_id'] = $projectDetails['id'];
                $transactionData['amount'] = $budget;
                $transactionData['paid'] = 1;
                $doTransaction = $this->transaction->add($transactionData);

                if ($deductAmount['isSuccess'] ==  true){
                    $taskFee = $budget / 100 * env('PERCENTAGE_PER_TASK');
                    $amountToTransfer = $budget - $taskFee;

                    $transferData['amount'] = $amountToTransfer;
                    $transferData['user_id'] = $projectDetails['assigned_to'];
                    $transferAmount = $this->wallet->add($transferData);

                    $transactionData['amount'] = $amountToTransfer;
                    $transactionData['paid'] = 0;
                    $doTransaction = $this->transaction->add($transactionData);

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

    public function addProjectQuery(Request $request){
        $data = $request->all();
        $query = $this->project->addProjectQuery($data);
        if ($query['isSuccess'] === true){
            Notify::success($query['message']);
        }else{
            Notify::error($query['message']);
        }
        return redirect()->back();
    }
}
