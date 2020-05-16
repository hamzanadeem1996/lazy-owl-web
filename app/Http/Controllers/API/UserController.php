<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User; 
use Illuminate\Support\Facades\Auth; 
use App\Repositories\User\UserInterface;
use App\Repositories\Degree\DegreeInterface;
use App\Repositories\Projects\ProjectInterface;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\SubCategory\SubCategoryInterface;
use App\Repositories\PaymentMethods\PaymentMethodsInterface;
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;
    protected $user;
    protected $project;
    protected $degree;
    protected $category;
    protected $subCategory;
    protected $payment;

    public function __construct(
        UserInterface           $user,
        ProjectInterface        $project,
        DegreeInterface         $degree,
        CategoryInterface       $category,
        SubCategoryInterface    $subCategory,
        PaymentMethodsInterface $payment
    ) {
        $this->user         = $user;
        $this->project      = $project;
        $this->degree       = $degree;
        $this->category     = $category;
        $this->subCategory  = $subCategory;
        $this->payment      = $payment;
    }
    
    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user();
            $token =  $user->createToken('LazyOwl')-> accessToken; 
            $activeProjetcs = $this->project->getProjectsByUserId($user['id'], $user['role']); 
            $assignedProjetcs = $this->project->getAssignedProjectsByUserId($user['id']);
            $completedProjects = $this->project->getCompletedProjectsByUserId($user['id'], $user['role']);
            $userWallet = 0;
            $userRating = 0;
            $userDegree = null;
            $userDegreeProgramme = null;
            $userPortfolio = null;
            $userImage = env('APP_URL')."/images/user/dummy.png";
            $userServices = [];

            if ($user->wallet) {
                $userWallet = $user->wallet->amount;
            }

            if (isset($user->ratings[0])) {
                $userRating = $user->ratings[0]->rating;
            }

            if (isset($user->degree)) {
                $userDegree = $user->degree->degree->title;
                $userDegreeProgramme = $user->degree->programme->title;
            }
            
            if (isset($user->portfolio)) {
                $userPortfolio = env('APP_URL')."/portfolio/". $user->portfolio->media;
            }

            if (isset($user->services[0])) {
                for($x=0; $x<count($user->services); $x++) {
                    $userServices[$x]['category'] = $user->services[$x]->category->name;
                    $userServices[$x]['sub_category'] = $user->services[$x]->sub_category->name;
                }
            }

            if ($user['image']) {
                $userImage = env('APP_URL')."/images/user/".$user['image'];
            }

            $user['completed_projects_count'] = count($completedProjects['projects']);
            $user['active_projects_count'] = count($activeProjetcs['projects']);
            $user['assigned_projects_count'] = count($assignedProjetcs);
            $user['wallet_amount'] = $userWallet;
            $user['ratings_star'] = $userRating;
            $user['degree_title'] = $userDegree;
            $user['degree_programme_title'] = $userDegreeProgramme;
            $user['profile_image_url'] = $userImage;
            $user['portfolio_url'] = $userPortfolio;
            $user['services_list'] = $userServices;

            unset($user['wallet']);
            unset($user['ratings']);
            unset($user['degree']);
            unset($user['portfolio']);
            unset($user['services']);
            unset($user['imaage']);

            return response()->json([
                'status' => 200,
                'message' => 'User logged in successfully!',
                'token' => $token,
                'user'=> $user
            ], 200); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised', 'status' => 400], 400); 
        } 
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
            'role' => 'required|integer'
        ]);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);
        $user->save();
        $token =  $user->createToken('LazyOwl')-> accessToken; 

        $activeProjetcs = $this->project->getProjectsByUserId($user['id'], $user['role']); 
        $assignedProjetcs = $this->project->getAssignedProjectsByUserId($user['id']);
        $completedProjects = $this->project->getCompletedProjectsByUserId($user['id'], $user['role']);
        $userWallet = 0;
        $userRating = 0;
        $userDegree = null;
        $userDegreeProgramme = null;
        $userPortfolio = null;
        $userServices = [];

        if ($user->wallet) {
            $userWallet = $user->wallet->amount;
        }

        if (isset($user->ratings[0])) {
            $userRating = $user->ratings[0]->rating;
        }

        if (isset($user->degree)) {
            $userDegree = $user->degree->degree->title;
            $userDegreeProgramme = $user->degree->programme->title;
        }
        
        if (isset($user->portfolio)) {
            $userPortfolio = env('APP_URL')."/portfolio/". $user->portfolio->media;
        }

        if (isset($user->services[0])) {
            for($x=0; $x<count($user->services); $x++) {
                $userServices[$x]['category'] = $user->services[$x]->category->name;
                $userServices[$x]['sub_category'] = $user->services[$x]->sub_category->name;
            }
        }

        $user['completed_projects_count'] = count($completedProjects['projects']);
        $user['active_projects_count'] = count($activeProjetcs['projects']);
        $user['assigned_projects_count'] = count($assignedProjetcs);
        $user['wallet_amount'] = $userWallet;
        $user['ratings_star'] = $userRating;
        $user['degree_title'] = $userDegree;
        $user['degree_programme_title'] = $userDegreeProgramme;
        $user['portfolio_url'] = $userPortfolio;
        $user['profile_image_url'] = env('APP_URL')."/images/user/dummy.png";
        $user['services_list'] = $userServices;

        unset($user['wallet']);
        unset($user['ratings']);
        unset($user['degree']);
        unset($user['portfolio']);
        unset($user['services']);
        
        return response()->json([
            'status' => 200,
            'message' => 'User logged in successfully!',
            'token' => $token,
            'user' => $user
        ], 200); 
    }

    public function logout(Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        
        return response()->json([
            'message' => 'Successfully logged out',
            'status'  => 200
        ]);
    }

    public function getUserById($id) {
        if (!$id) {
            return response()->json([
                'message' => 'Invalid parameters',
                'status'  => 400
            ]);
        }

        $user = $this->user->get($id);
    
        $activeProjetcs = $this->project->getProjectsByUserId($id, $user['role']); 
        $assignedProjetcs = $this->project->getAssignedProjectsByUserId($id);
        $completedProjects = $this->project->getCompletedProjectsByUserId($id, $user['role']);
        $userWallet = 0;
        $userRating = 0;
        $userDegree = null;
        $userDegreeProgramme = null;
        $userPortfolio = null;
        $userImage = env('APP_URL')."/images/user/dummy.png";
        $userServices = [];

        if ($user->wallet) {
            $userWallet = $user->wallet->amount;
        }

        if (isset($user->ratings[0])) {
            $userRating = $user->ratings[0]->rating;
        }

        if (isset($user->degree)) {
            $userDegree = $user->degree->degree->title;
            $userDegreeProgramme = $user->degree->programme->title;
        }
        
        if (isset($user->portfolio)) {
            $userPortfolio = env('APP_URL')."/portfolio/". $user->portfolio->media;
        }

        if (isset($user->services[0])) {
            for($x=0; $x<count($user->services); $x++) {
                $userServices[$x]['category'] = $user->services[$x]->category->name;
                $userServices[$x]['sub_category'] = $user->services[$x]->sub_category->name;
            }
        }

        if ($user['image']) {
            $userImage = env('APP_URL')."/images/user/".$user['image'];
        }

        $user['completed_projects_count'] = count($completedProjects['projects']);
        $user['active_projects_count'] = count($activeProjetcs['projects']);
        $user['assigned_projects_count'] = count($assignedProjetcs);
        $user['wallet_amount'] = $userWallet;
        $user['ratings_star'] = $userRating;
        $user['degree_title'] = $userDegree;
        $user['degree_programme_title'] = $userDegreeProgramme;
        $user['portfolio_url'] = $userPortfolio;
        $user['profile_image_url'] = $userImage;
        $user['services_list'] = $userServices;

        unset($user['wallet']);
        unset($user['ratings']);
        unset($user['degree']);
        unset($user['portfolio']);
        unset($user['services']);
        unset($user['image']);

        return response()->json([
            'message' => 'Success',
            'status'  => 200,
            'user'    => $user
        ]);
    }

    public function updateUserProfile(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'gender' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'description' => 'required|string',
            'id' => 'required|integer'
        ]);
        $data = $request->all();
        $user = $this->user->update($data);
        return $user;
    }

    public function updateUserProfileImage(Request $request) {
        $request->validate([
            'user_id' => 'required|integer',
            'image' => 'required',
            'file' => 'required'
        ]);
        $data = $request->all();
        $user = $this->user->addProfileImage($data);
        $user['profile_image_url'] = env('APP_URL')."/images/user/".$user['imageName'];
        unset($user['imageName']);
        return $user;
    }

    public function updateUserEducation(Request $request) {
        $request->validate([
            'degree' => 'required|integer',
            'programme' => 'required|integer',
            'id' => 'required|integer'
        ]);
        $data = $request->all();
        $user = $this->user->addQualification($data);
        return $user;
    }

    public function updateUserPortfolio(Request $request) {
        $request->validate([
            'portfolio' => 'required',
            'id' => 'required|integer'
        ]);
        $data = $request->all();
        $user = $this->user->addPortfolio($data);
        return $user;
    }

    public function getAllActiveDegrees() {
        $degrees = $this->degree->getActive();
        foreach($degrees as $degree) {
            $degree['programmes'] = $degree->degree_programme;
        }
        return response()->json([
            'status' => 200,
            'message' => 'Success',
            'degrees' => $degrees
        ]);
    }

    public function getAllServices() {
        $services = $this->category->all();
        foreach($services as $service) {
            $service['sub_categories'] = $service->sub_categories;
        }
        return $services;
    }

    public function addCardDetails(Request $request) {
        $request->validate([
            'user_id' => 'required|integer',
            'payment_method_id' => 'required|integer',
            'bank_name' => 'required|string',
            'acc_title' => 'required|string',
            'acc_number' => 'required|string',
            'branch_code' => 'required|string'
        ]);
        $data = $request->all();
        $paymentMethod = $this->payment->addUserAccountDetails($data);
        return $paymentMethod;
    }

    public function getCardDetails($id) {
        if (!$id) {
            return response()->json([
                'status' => 400,
                'messgae' => 'Invalid Parameters',
                'isSuccess' => false,
            ]);
        }
        $card = $this->payment->getUserCardDetails($id);
        return response()->json([
            'status' => 200,
            'messgae' => 'Success',
            'isSuccess' => true,
            'card' => count($card) > 0 ? $card[0]: $card
        ]);
    }

    public function getPaymentMethods() {
        $methods = $this->payment->all();
        return response()->json([
            'status' => 200,
            'messgae' => 'Success',
            'isSuccess' => true,
            'payment_methods' => $methods
        ]);
    }

    public function getUserTransactions($id) {
        if (!$id) {
            return response()->json([
                'status' => 400,
                'messgae' => 'Invalid Parameters',
                'isSuccess' => false,
            ]);
        }

        $user = $this->user->get($id);
        $payments['card_payments'] = $user->payments;
        $payments['wallet_payments'] = $user->transactions;
        return response()->json([
            'status' => 200,
            'messgae' => 'Success',
            'isSuccess' => true,
            'payments' => $payments
        ]);
    }

    public function changeUserPassword(Request $request) {
        $data = $request->all();
        $request->validate([
            'user_id' => 'required|integer',
            'password' => 'required|string'
        ]);
        $password = $this->user->changePassword($data);
        return $password;
    }
}
