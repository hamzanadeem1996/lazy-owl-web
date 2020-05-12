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
        $project['media'] = env('APP_URL')."/images/project/".$project['media'];

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
        $category = $this->category->get($project['project']['cat_id']);
        $subCategory = $this->subCategory->get($project['project']['sub_cat_id']);
        $user = $this->user->get($project['project']['user_id']);
        
        $project['project']['category'] = $category['name'];
        $project['project']['sub_category'] = $subCategory['name'];
        $project['project']['posted_by'] = $user['name'];
        
        return response()->json($project, 200);
    }
}
