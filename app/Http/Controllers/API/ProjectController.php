<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Projects\ProjectInterface;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\SubCategory\SubCategoryInterface;
use App\Repositories\User\UserInterface;
use App\Repositories\Wallet\WalletInterface;
use App\Repositories\Transactions\TransactionsInterface;
use App\Repositories\Bid\BidRepositoryInterface;
use App\Projects;
use Validator;

class ProjectController extends Controller
{
    protected $project;
    protected $category;
    protected $subCategory;
    protected $user;
    protected $wallet;
    protected $transaction;
    protected $bid;

    public function __construct(
        ProjectInterface        $project,
        CategoryInterface       $category,
        SubCategoryInterface    $subCategory,
        UserInterface           $user,
        WalletInterface         $wallet,
        TransactionsInterface   $transaction,
        BidRepositoryInterface  $bid
    ){
        $this->project          = $project;
        $this->category         = $category;
        $this->subCategory      = $subCategory;
        $this->user             = $user;
        $this->wallet           = $wallet;
        $this->transaction      = $transaction;
        $this->bid              = $bid;
    }

    public function getActiveProjects(Request $request) {
        $offset = $request->input('page');
        $limit = $request->input('limit');

        if (!$offset || !$limit) {
            return response()->json([
                'status' => 401,
                'message' => 'Some query parameters are missing'
            ], 401);
        }
        $projects = $this->project->getUnAssignedProjects($offset, $limit);
        
        foreach($projects as $project) {
            $category = $this->category->get($project['cat_id']);
            $subCategory = $this->subCategory->get($project['sub_cat_id']);
            $user = $this->user->get($project['user_id']);
            $project['category'] = $category['name'];
            $project['sub_category'] = $subCategory['name'];
            $project['posted_by'] = $user['name'];
            if (isset($project['media'])) {
                $project['media_url'] = env('APP_URL')."/images/project/".$project['media'];
            } else {
                $project['media_url'] = null;
            }
            unset($project['media']);
        }

        return response()->json([
            'isSuccess' => true,
            'status' => 200,
            'message' => 'Success',
            'tasks' => $projects
        ], 200);
    }

    public function searchProjects(Request $request) {
        $offset = $request->input('page');
        $limit = $request->input('limit');

        if (!$offset || !$limit) {
            return response()->json([
                'status' => 401,
                'message' => 'Some query parameters are missing'
            ], 401);
        }
        $title = $request->input('title');
        $filtered = $this->project->searchProjects($title, $offset, $limit);

        foreach($filtered as $project) {
            $category = $this->category->get($project['cat_id']);
            $subCategory = $this->subCategory->get($project['sub_cat_id']);
            $user = $this->user->get($project['user_id']);
            $project['category'] = $category['name'];
            $project['sub_category'] = $subCategory['name'];
            $project['posted_by'] = $user['name'];
            if (isset($project['media'])) {
                $project['media_url'] = env('APP_URL')."/images/project/".$project['media'];
            } else {
                $project['media_url'] = null;
            }
            unset($project['media']);
        }

        return response()->json([
            'isSuccess' => true,
            'status' => 200,
            'message' => 'Success',
            'tasks' => $filtered
        ], 200);
    }

    public function getProjectById($id) {
        if (!$id) {
            return response()->json([
                'status' => 401,
                'message' => 'Some url parameters are missing'
            ], 401);
        }

        $project = $this->project->get($id);
        $category = $this->category->get($project['cat_id']);
        $subCategory = $this->subCategory->get($project['sub_cat_id']);
        $user = $this->user->get($project['user_id']);
        $project['category'] = $category['name'];
        $project['sub_category'] = $subCategory['name'];
        $project['posted_by'] = $user['name'];
        $project['media_url'] = env('APP_URL')."/images/project/".$project['media'];

        unset($project['media']);

        return response()->json([
            'isSuccess' => true,
            'status' => 200,
            'message' => 'Success',
            'tasks' => $project
        ], 200);
    }

    public function bidOnProject(Request $request) {
        $data = $request->all();
        $request->validate([
            'user_id'       => 'required|integer',
            'project_id'    => 'required|integer',
            'amount'        => 'required|integer'
        ]);
        
        $addBid = $this->bid->add($data);
        return response()->json($addBid, 200);
    }

    public function addProject(Request $request) {
        $data = $request->all();
        // return response()->json($data, 200);
        $request->validate([
            'user_id'           => 'required|integer',
            'title'             => 'required|string',
            'cat_id'            => 'required|integer',
            'sub_cat_id'        => 'required|integer',
            'description'       => 'required|string',
            'location'          => 'required|string',
            'due_date'          => 'required|string',
            'budget'            => 'required|integer',
            'people_required'   => 'required|integer',
        ]);

        if ($files = $request->file('file')) {
            $data['files'] = $files;
        }else{
            $data['files'] = null;
        }
        
        $project = $this->project->add($data);
        if ($project['project']['media']) {
            $project['project']['media_url'] = env('APP_URL')."/images/project/".$project['project']['media'];
        } else {
            $project['project']['media_url'] = null;
        }
        
        unset($project['project']['media']);
        $category = $this->category->get($project['project']['cat_id']);
        $subCategory = $this->subCategory->get($project['project']['sub_cat_id']);
        $user = $this->user->get($project['project']['user_id']);
        
        $project['project']['category'] = $category['name'];
        $project['project']['sub_category'] = $subCategory['name'];
        $project['project']['posted_by'] = $user['name'];
        
        return response()->json($project, 200);
    }

    public function getUserTasks(Request $request, $userId) {
        if (!$userId) {
            return response()->json([
                'message' => 'Invalid parameters',
                'status'  => 400
            ]);
        }

        $offset = $request->input('page');
        $limit = $request->input('limit');

        if (!$offset || !$limit) {
            return response()->json([
                'status' => 401,
                'message' => 'Some query parameters are missing'
            ], 401);
        }

        $projects = [];
        $user = $this->user->get($userId);
        
        if ($user) {
            if ($user['role'] != 4){
                $userRole = $user['role'];
                $activeprojects = $this->project->getProjectsByUserId($userId, $userRole, $offset, $limit);
                $completedProjects = $this->project->getCompletedProjectsByUserId($userId, $userRole, $offset, $limit);
                $discardedProjects = $this->project->getDiscardedProjectsByUserId($userId, $userRole, $offset, $limit);

                foreach($activeprojects['projects'] as $project){
                    $category = $this->category->get($project['cat_id']);
                    $subCategory = $this->subCategory->get($project['sub_cat_id']);
                    $user = $this->user->get($project['user_id']);
                    $project['category'] = $category['name'];
                    $project['sub_category'] = $subCategory['name'];
                    $project['posted_by'] = $user['name'];
                    if (isset($project['media'])){
                        $project['media_url'] = env('APP_URL')."/images/project/".$project['media'];
                    } else {
                        $project['media_url'] = null;
                    }
                    unset($project['media']);
                    $project['bids'] = $this->bid->all($project['id']);
                }

                foreach($completedProjects['projects'] as $project){
                    $category = $this->category->get($project['cat_id']);
                    $subCategory = $this->subCategory->get($project['sub_cat_id']);
                    $user = $this->user->get($project['user_id']);
                    $project['category'] = $category['name'];
                    $project['sub_category'] = $subCategory['name'];
                    $project['posted_by'] = $user['name'];
                    if (isset($project['media'])){
                        $project['media_url'] = env('APP_URL')."/images/project/".$project['media'];
                    } else {
                        $project['media_url'] = null;
                    }
                    unset($project['media']);
                    $project['bids'] = $this->bid->all($project['id']);
                }

                foreach($discardedProjects['projects'] as $project){
                    $category = $this->category->get($project['cat_id']);
                    $subCategory = $this->subCategory->get($project['sub_cat_id']);
                    $user = $this->user->get($project['user_id']);
                    $project['category'] = $category['name'];
                    $project['sub_category'] = $subCategory['name'];
                    $project['posted_by'] = $user['name'];
                    if (isset($project['media'])){
                        $project['media_url'] = env('APP_URL')."/images/project/".$project['media'];
                    } else {
                        $project['media_url'] = null;
                    }
                    unset($project['media']);
                    $project['bids'] = $this->bid->all($project['id']);
                }

                $projects['active_projects'] = $activeprojects['projects'];
                $projects['completed_projects'] = $completedProjects['projects'];
                $projects['discarded_projects'] = $discardedProjects['projects']; 
            }else{
                $projects = $this->project->getConsultantProjects($userId, $offset, $limit);
                foreach($projects['active_projects'] as $project){
                    $category = $this->category->get($project['cat_id']);
                    $subCategory = $this->subCategory->get($project['sub_cat_id']);
                    $user = $this->user->get($project['user_id']);
                    $project['category'] = $category['name'];
                    $project['sub_category'] = $subCategory['name'];
                    $project['posted_by'] = $user['name'];
                    if (isset($project['media'])){
                        $project['media_url'] = env('APP_URL')."/images/project/".$project['media'];
                    } else {
                        $project['media_url'] = null;
                    }
                    unset($project['media']);
                    $project['bids'] = $this->bid->all($project['id']);
                }

                foreach($projects['posted_projects'] as $project){
                    $category = $this->category->get($project['cat_id']);
                    $subCategory = $this->subCategory->get($project['sub_cat_id']);
                    $user = $this->user->get($project['user_id']);
                    $project['category'] = $category['name'];
                    $project['sub_category'] = $subCategory['name'];
                    $project['posted_by'] = $user['name'];
                    if (isset($project['media'])){
                        $project['media_url'] = env('APP_URL')."/images/project/".$project['media'];
                    } else {
                        $project['media_url'] = null;
                    }
                    unset($project['media']);
                    $project['bids'] = $this->bid->all($project['id']);
                }

                foreach($projects['discarded_projects'] as $project){
                    $category = $this->category->get($project['cat_id']);
                    $subCategory = $this->subCategory->get($project['sub_cat_id']);
                    $user = $this->user->get($project['user_id']);
                    $project['category'] = $category['name'];
                    $project['sub_category'] = $subCategory['name'];
                    $project['posted_by'] = $user['name'];
                    if (isset($project['media'])){
                        $project['media_url'] = env('APP_URL')."/images/project/".$project['media'];
                    } else {
                        $project['media_url'] = null;
                    }
                    unset($project['media']);
                    $project['bids'] = $this->bid->all($project['id']);
                }

                foreach($projects['completed_projects']['assigned'] as $project){
                    $category = $this->category->get($project['cat_id']);
                    $subCategory = $this->subCategory->get($project['sub_cat_id']);
                    $user = $this->user->get($project['user_id']);
                    $project['category'] = $category['name'];
                    $project['sub_category'] = $subCategory['name'];
                    $project['posted_by'] = $user['name'];
                    if (isset($project['media'])){
                        $project['media_url'] = env('APP_URL')."/images/project/".$project['media'];
                    } else {
                        $project['media_url'] = null;
                    }
                    unset($project['media']);
                    $project['bids'] = $this->bid->all($project['id']);
                }

                foreach($projects['completed_projects']['posted'] as $project){
                    $category = $this->category->get($project['cat_id']);
                    $subCategory = $this->subCategory->get($project['sub_cat_id']);
                    $user = $this->user->get($project['user_id']);
                    $project['category'] = $category['name'];
                    $project['sub_category'] = $subCategory['name'];
                    $project['posted_by'] = $user['name'];
                    if (isset($project['media'])){
                        $project['media_url'] = env('APP_URL')."/images/project/".$project['media'];
                    } else {
                        $project['media_url'] = null;
                    }
                    unset($project['media']);
                    $project['bids'] = $this->bid->all($project['id']);
                }
            }
            return response()->json([
                'message' => 'Success',
                'status'  => 200,
                'isSuccess' => true,
                'projects' => $projects
            ]); 
        } else {
            return response()->json([
                'message' => 'Invalid user ID',
                'status'  => 400
            ]); 
        }
    }

    public function acceptBid($id) {
        if (!$id) {
            return response()->json([
                'message' => 'Invalid parameters',
                'status'  => 400
            ]); 
        }

        $assignTask = $this->bid->acceptBid($id);
        return $assignTask;
    }

    public function editUserProject(Request $request) {
        $data = $request->all();
        $request->validate([
            'id'           => 'required|integer',
            'user_id'           => 'required|integer',
            'title'             => 'required|string',
            'cat_id'            => 'required|integer',
            'sub_cat_id'        => 'required|integer',
            'description'       => 'required|string',
            'location'          => 'required|string',
            'due_date'          => 'required|string',
            'budget'            => 'required|integer',
            'people_required'   => 'required|integer',
        ]);

        if ($files = $request->file('file')) {
            $data['files'] = $files;
        }else{
            $data['files'] = null;
        }
        
        $project = $this->project->update($data);
        if ($project['project']['media']) {
            $project['project']['media_url'] = env('APP_URL')."/images/project/".$project['project']['media'];
        } else {
            $project['project']['media_url'] = null;
        }
        
        unset($project['project']['media']);
        $category = $this->category->get($project['project']['cat_id']);
        $subCategory = $this->subCategory->get($project['project']['sub_cat_id']);
        $user = $this->user->get($project['project']['user_id']);
        
        $project['project']['category'] = $category['name'];
        $project['project']['sub_category'] = $subCategory['name'];
        $project['project']['posted_by'] = $user['name'];
        
        return response()->json($project, 200);
    }

    public function discardUserProject($id) {
        if (!$id) {
            return response()->json([
                'status' => 400,
                'isSuccess' => false,
                'message' => 'Invalid parameters'
            ]);
        }

        $project = $this->project->markDiscarded($id);
        return $project;
    }

    public function markCompletedUserTask($id) {
        if (!$id) {
            return response()->json([
                'status' => 400,
                'isSuccess' => false,
                'message' => 'Invalid parameters'
            ]);
        }

        $project = $this->project->markComplete($id);
        return $project;
    }

    public function addUserTaskQuery(Request $request) {
        $data = $request->all();
        $request->validate([
            'project_id'     => 'required|integer',
            'user_id'       => 'required|integer',
            'query'         => 'required|string',
        ]);
        $query = $this->project->addProjectQuery($data);
        return $query;
    }
}
