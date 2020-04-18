<?php

namespace App\Http\Controllers;
use App\Repositories\User\UserInterface;
use App\Repositories\Degree\DegreeInterface;
use App\Repositories\Programme\ProgrammeInterface;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\SubCategory\SubCategoryInterface;
use App\Repositories\ServiceProvider\ServiceProviderInterface;
use Illuminate\Http\Request;
use Jleon\LaravelPnotify\Notify;

class UserController extends Controller
{
    protected $user;
    protected $degree;
    protected $programe;
    protected $category;
    protected $subCategory;
    protected $serviceProvider;

    public function __construct(
        UserInterface $user, 
        DegreeInterface $degree, 
        ProgrammeInterface $programe,
        CategoryInterface $category,
        SubCategoryInterface $subCategory,
        ServiceProviderInterface $serviceProvider
    ){
        $this->user             = $user;
        $this->degree           = $degree;
        $this->programe         = $programe;
        $this->category         = $category;
        $this->subCategory      = $subCategory;
        $this->serviceProvider  = $serviceProvider;
    }

    public function index(){
        $categories = $this->category->all();
        return view('user.dashboard', compact('categories'));
    }

    public function userProfileView($id){
        $user = $this->user->get($id);
        return view('user.account', compact('user'));
    }

    public function getQualification(){
        return view('user.qualification');
    }

    public function getUserAccount($id){
        $user = $this->user->get($id);
        $degrees = $this->degree->getActive();
        $categories = $this->category->all();
        return view('user.account', compact('user', 'degrees', 'categories'));
    }

    public function updateUserProfileImage(Request $request){
        $data = $request->all();
        $image = $request->file('file');
        $data['image'] = $image;
        
        if ($data && $image){
            $user = $this->user->addProfileImage($data);
            return json_encode($user);
        }else{
            $response = Array([
                'message' => 'No image selected'
            ]);
            return json_encode($response);
        }
    }

    public function editUserProfile(Request $request){
        $data = $request->all();
        $user = $this->user->update($data);
        if ($user['isSuccess'] === false){
            Notify::error($user['message']);
            return redirect()->back();
        }else{
            Notify::success($user['message']);
            return redirect()->back();
        }
    }

    public function updateUserQualification(Request $request){
        $data = $request->all();
        $user = $this->user->addQualification($data);
        if ($user['isSuccess'] === false){
            Notify::error($user['message']);
            return redirect()->back();
        }else{
            Notify::success($user['message']);
            return redirect()->back();
        }
    }

    public function updateUserPortfolio(Request $request){
        $data = $request->all();
        $portfolio = $request->file('portfolio');
        if ($portfolio){
            $data['portfolio'] = $portfolio;
        }
        $user = $this->user->addPortfolio($data);
        if ($user['isSuccess'] === false){
            Notify::error($user['message']);
            return redirect()->back();
        }else{
            Notify::success($user['message']);
            return redirect()->back();
        }
    }

    public function updateUserServices(Request $request){
        $data = $request->all();
        $services = $this->serviceProvider->add_services($data);
        if ($services['isSuccess'] == true){
            Notify::success($services['message']);
        }else{
            Notify::error($services['message']);
        }
        return redirect()->back();
    }
}
