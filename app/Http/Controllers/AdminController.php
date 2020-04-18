<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jleon\LaravelPnotify\Notify;
use App\Repositories\User\UserInterface;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\SubCategory\SubCategoryInterface;
use App\Repositories\Reviews\ReviewsInterface;
use App\Repositories\ServiceProvider\ServiceProviderInterface;
use App\Repositories\Consultant\ConsultantInterface;
use App\Repositories\Projects\ProjectInterface;
use App\Repositories\Degree\DegreeInterface;
use App\Repositories\Programme\ProgrammeInterface;
use App\Repositories\Admin\AdminRepositoryInterface;
// use MongoDB\Driver\Session;


class AdminController extends Controller
{
    protected $user;
    protected $category;
    protected $subCategory;
    protected $reviews;
    protected $consultant;
    protected $project;
    protected $degree;
    protected $programme;
    protected $admin;
    protected $serviceProvider;

    public function __construct(
        UserInterface $user,
        CategoryInterface $category,
        SubCategoryInterface $subCategory,
        ReviewsInterface $reviews,
        ServiceProviderInterface $serviceProvider,
        ConsultantInterface $consultant,
        ProjectInterface $project,
        DegreeInterface $degree,
        ProgrammeInterface $programme,
        AdminRepositoryInterface $admin
    ){

        $this->user            = $user;
        $this->category        = $category;
        $this->subCategory     = $subCategory;
        $this->reviews         = $reviews;
        $this->serviceProvider = $serviceProvider;
        $this->consultant      = $consultant;
        $this->project         = $project;
        $this->degree          = $degree;
        $this->programme       = $programme;
        $this->admin           = $admin;
    }

    public function index(){
        return view('admin.dashboard');
    }

    public function logOut(){
        Auth::logout();
        return redirect('/');
    }

    public function getAdminProfile(){
       $profile = $this->admin->get_admin_profile();
       $profile_data = $profile['data'];
       $password = $profile['password'];
       return view('admin.edit_profile', compact('profile_data','password'));
    }

    public function passwordUpdate(Request $request){
        if($request->validate(['new_password' => 'required|min:8'])) {
            $data = $request->all();
            $password = $this->admin->passwordUpdate($data);
            if ($password['isSuccess'] == true){
                Notify::success($password['message']);
            }else{
                Notify::error($password['message']);
            }
            return redirect()->back();
        }
    }

    //user section
    public function addUserForm(){
        return view('admin.add_user_form');
    }

    public function addUserPost(Request $request){
        $data = $request->all();
        if ($files = $request->file('image')) {
            $data['files'] = $files;
        }else{
            $data['files'] = null;
        }
        $addUser = $this->user->add($data);
        if ($addUser['isSuccess'] === false){
            Notify::error($addUser['message']);
            return redirect()->back();
        }else{
            Notify::success($addUser['message']);
            return redirect()->back();
        }
    }

    public function editUserPost(Request $request){
        $data = $request->all();

        if ($files = $request->file('image')) {
            $data['files'] = $files;
        }

        $editUser = $this->user->update($data);
        if ($editUser['isSuccess'] === false){
            Notify::error($editUser['message']);
            return redirect()->back();
        }else{
            Notify::success($editUser['message']);
            return redirect()->back();
        }
    }

    public function getActiveUsers(){
        $users = $this->user->all(2);
        $userType = 'Active Users';
        return view('admin.user.users_list', compact('users', 'userType'));
    }

    public function markUserDisable(Request $request){
        $data = $request->all();
        $user = $this->user->delete($data['id']);
        if ($user['isSuccess'] === false){
            Notify::error($user['message']);
            return redirect()->back();
        }else{
            Notify::success($user['message']);
            return redirect()->back();
        }
    }

    public function getDisabledUsers(){
        $users = $this->user->disabled(2);
        $userType = 'Disabled Users';
        return view('admin.user.users_list', compact('users', 'userType'));
    }

    public function editUserForm($id){
        $user = $this->user->get($id);
        $degrees = $this->degree->getActive();
        return view('admin.user.edit_user', compact('user', 'degrees'));
    }

    public function deleteComment(Request $request){
        $data = $request->all();
        $review = $this->reviews->delete($data['id']);
        if ($review['isSuccess'] == true){
            Notify::success($review['message']);
        }else{
            Notify::error($review['message']);
        }
        return redirect()->back();
    }

//    Service Provider Section

    public function editServiceProviderPost(Request $request){
        $data = $request->all();

        if ($files = $request->file('image')) {
            $data['files'] = $files;
        }

        $editUser = $this->user->update($data);
        if ($editUser['isSuccess'] === false){
            Notify::error($editUser['message']);
            return redirect()->back();
        }else{
            Notify::success($editUser['message']);
            return redirect()->back();
        }
    }

    public function getActiveServiceProvider(){
        $users = $this->user->all(3);
        $userType = 'Active Service Provider';
        return view('admin.service-provider.service_provider_list', compact('users', 'userType'));
    }

    public function getDisabledServiceProvider(){
        $users = $this->user->disabled(3);
        $userType = 'Disabled Service Provider';
        return view('admin.service-provider.service_provider_list', compact('users', 'userType'));
    }

    public function editServiceProviderForm($id){
        $user = $this->user->get($id);
        $categories = $this->category->all();
        $sub_categories = $this->subCategory->all();
        return view('admin.service-provider.edit_service_provider', compact('user', 'categories', 'sub_categories'));
    }

    public function editServiceProviderServicesPost(Request $request){
        $data = $request->all();
        $services = $this->serviceProvider->add_services($data);
        if ($services['isSuccess'] == true){
            Notify::success($services['message']);
        }else{
            Notify::error($services['message']);
        }
        return redirect()->back();
    }

    public function deleteServiceProviderService(Request $request){
        $data = $request->all();
        $service = $this->serviceProvider->delete_service($data);
        if ($service['isSuccess'] === false){
            Notify::error($service['message']);
            return redirect()->back();
        }else{
            Notify::success($service['message']);
            return redirect()->back();
        }
    }

//    Consultant section

    public function editConsultantPost(Request $request){
        $data = $request->all();

        if ($files = $request->file('image')) {
            $data['files'] = $files;
        }

        $editUser = $this->user->update($data);
        if ($editUser['isSuccess'] === false){
            Notify::error($editUser['message']);
            return redirect()->back();
        }else{
            Notify::success($editUser['message']);
            return redirect()->back();
        }
    }

    public function getActiveConsultant(){
        $users = $this->user->all(4);
        $userType = 'Active Consultant';
        return view('admin.consultant.consultant_list', compact('users', 'userType'));
    }

    public function getDisabledConsultant(){
        $users = $this->user->disabled(4);
        $userType = 'Disabled Consultant';
        return view('admin.consultant.consultant_list', compact('users', 'userType'));
    }

    public function editConsultantForm($id){
        $user = $this->user->get($id);
        $categories = $this->category->all();
        $sub_categories = $this->subCategory->all();
        return view('admin.consultant.edit_consultant', compact('user', 'categories', 'sub_categories'));
    }

    public function editConsultantExperiencePost(Request $request) {
        $data = $request->all();
        $experience = $this->consultant->add_experience($data);
        if ($experience['isSuccess'] === true){
            Notify::success($experience['message']);
        }else{
            Notify::error($experience['message']);
        }
        return redirect()->back();
    }

    public function deleteConsultantExperience(Request $request){
        $data = $request->all();
        $delete_experience = $this->consultant->delete_experience($data);
        if ($delete_experience['isSuccess'] === true){
            Notify::success($delete_experience['message']);
        }else{
            Notify::error($delete_experience['message']);
        }
        return redirect()->back();
    }

//    Category Section start

    public function addCategoryForm(){
        return view('admin.category.add_category_form');
    }

    public function addCategoryPost(Request $request){
        $data = $request->all();
        if ($files = $request->file('image')) {
            $data['files'] = $files;
        }else{
            $data['files'] = null;
        }
        $addCategory = $this->category->add($data);
        if ($addCategory['isSuccess'] === false){
            Notify::error($addCategory['message']);
            return redirect()->back();
        }else{
            Notify::success($addCategory['message']);
            return redirect()->back();
        }
    }

    public function editCategoryPost(Request $request){
        $data = $request->all();

        if ($files = $request->file('image')) {
            $data['files'] = $files;
        }else{
            $data['files'] = null;
        }

        $category = $this->category->update($data);
        if ($category['isSuccess'] === false){
            Notify::error($category['message']);
            return redirect()->back();
        }else{
            Notify::success($category['message']);
            return redirect()->back();
        }
    }

    public function getActiveCategory(){
        $categories = $this->category->all();
        $categoryType = 'Active Categories';
        return view('admin.category.category_list', compact('categories', 'categoryType'));
    }

    public function markCategoryDisable(Request $request){
        $data = $request->all();
        $category = $this->category->delete($data['id']);
        if ($category['isSuccess'] === false){
            Notify::error($category['message']);
            return redirect()->back();
        }else{
            Notify::success($category['message']);
            return redirect()->back();
        }
    }

    public function getDisabledCategory(){
        $categories = $this->category->disabled();
        $categoryType = 'Disabled Categories';
        return view('admin.category.category_list', compact('categories', 'categoryType'));
    }

    public function editCategoryForm($id){
        $category = $this->category->get($id);
        return view('admin.category.edit_category', compact('category'));
    }

    public function showSubCategories($id){
        $allCategories = $this->category->get($id)->sub_categories;
        $categories = array();
        foreach ($allCategories as $cat){
            if ($cat->status == 1){
                $categories[] = $cat;
            }
        }
        $categoryType = 'Active Sub Categories';
        return view('admin.sub-category.sub_category_list', compact('categories', 'categoryType'));
    }

//    Sub Category Section

    public function addSubCategoryForm(){
        $categories = $this->category->all();
        return view('admin.sub-category.add_sub_category_form', compact('categories'));
    }

    public function addSubCategoryPost(Request $request){
        $data = $request->all();
        $addCategory = $this->subCategory->add($data);
        if ($addCategory['isSuccess'] === false){
            Notify::error($addCategory['message']);
            return redirect()->back();
        }else{
            Notify::success($addCategory['message']);
            return redirect()->back();
        }
    }

    public function editSubCategoryPost(Request $request){
        $data = $request->all();
        $category = $this->subCategory->update($data);
        if ($category['isSuccess'] === false){
            Notify::error($category['message']);
            return redirect()->back();
        }else{
            Notify::success($category['message']);
            return redirect()->back();
        }
    }

    public function getActiveSubCategory(){
        $categories = $this->subCategory->all();
        $categoryType = 'Active Sub Categories';
        return view('admin.sub-category.sub_category_list', compact('categories', 'categoryType'));
    }

    public function markSubCategoryDisable(Request $request){
        $data = $request->all();
        $category = $this->subCategory->delete($data['id']);
        if ($category['isSuccess'] === false){
            Notify::error($category['message']);
            return redirect()->back();
        }else{
            Notify::success($category['message']);
            return redirect()->back();
        }
    }

    public function getDisabledSubCategory(){
        $categories = $this->subCategory->disabled();
        $categoryType = 'Disabled Sub Categories';
        return view('admin.sub-category.sub_category_list', compact('categories', 'categoryType'));
    }

    public function editSubCategoryForm($id){
        $category = $this->subCategory->get($id);
        $categories = $this->category->all();
        return view('admin.sub-category.edit_sub_category', compact('category', 'categories'));
    }

//    Project Section Start

    public function addProjectForm(){
        $categories = $this->category->all();
        $subCategories = $this->subCategory->all();
        return view('admin.project.add_project_form', compact('categories', 'subCategories'));
    }

    public function addProjectPost(Request $request){
        $data = $request->all();
        if ($files = $request->file('file')) {
            $data['files'] = $files;
        }else{
            $data['files'] = null;
        }
        $project = $this->project->add($data);
        if ($project['isSuccess'] === true){
            Notify::success($project['message']);
        }else{
            Notify::error($project['message']);
        }
        return redirect()->back();
    }

    public function getActiveProject(){
        $projects = $this->project->pending();
        $projectType = 'Active Projects';
        return view('admin.project.active_projects_list', compact('projects', 'projectType'));
    }

    public function projectActions(Request $request) {
        $data = $request->all();
        if ($data['project_type'] === 'Active Projects'){
            if($data['action_id'] == 1){
                $project = $this->project->markComplete($data['id']);
            }else{
                $project = $this->project->markDiscarded($data['id']);
            }
        }elseif ($data['project_type'] === 'Completed Projects'){
            if($data['action_id'] == 1){
                $project = $this->project->markActive($data['id']);
            }else{
                $project = $this->project->markDiscarded($data['id']);
            }
        }elseif($data['project_type'] === 'Discarded Projects'){
            if($data['action_id'] == 1){
                $project = $this->project->markComplete($data['id']);
            }else{
                $project = $this->project->markActive($data['id']);
            }
        }
        if ($project['isSuccess'] === true){
            Notify::success($project['message']);
        }else{
            Notify::error($project['message']);
        }
        return redirect()->back();
    }

    public function completedProjectsList() {
        $projects = $this->project->completed();
        $projectType = 'Completed Projects';
        return view('admin.project.active_projects_list', compact('projects', 'projectType'));
    }

    public function getDiscardedProjects() {
        $projects = $this->project->discarded();
        $projectType = 'Discarded Projects';
        return view('admin.project.active_projects_list', compact('projects', 'projectType'));
    }

    public function editProjectForm($id){
        $project = $this->project->get($id);
        $categories = $this->category->all();
        $subCategories = $this->subCategory->all();
        return view('admin.project.edit_project', compact('categories', 'subCategories', 'project'));
    }

    public function editProjectPost(Request $request){
        $data = $request->all();
        if ($files = $request->file('file')) {
            $data['files'] = $files;
        }else{
            $data['files'] = null;
        }
        
        $project = $this->project->update($data);
        if($project['isSuccess'] === true){
            Notify::success($project['message']);
        }else{
            Notify::error($project['message']);
        }
        return redirect()->back();
    }

//  Degree Routes

    public function addDegreeForm() {
        return view('admin.degree.add_degree_form');
    }

    public function addDegreePost(Request $request) {
        $data = $request->all();
        $degree = $this->degree->add($data);

        if ($degree['isSuccess'] === true){
            Notify::success($degree['message']);
        }else{
            Notify::error($degree['message']);
        }
        return redirect()->back();
    }

    public function getActiveDegrees() {
        $degrees = $this->degree->getActive();
        $degreeType = 'Active Degree';
        return view('admin.degree.all_degrees_list', compact('degrees','degreeType'));
    }

    public function getDisabledDegrees() {
        $degrees = $this->degree->getDisabled();
        $degreeType = 'Disabled Degree';
        return view('admin.degree.all_degrees_list', compact('degrees','degreeType'));
    }

    public function deleteDegree(Request $request) {
        $data = $request->all();
        $degree = $this->degree->delete($data);
        if ($degree['isSuccess'] === true){
            Notify::success($degree['message']);
        }else{
            Notify::error($degree['message']);
        }
        return redirect()->back();
    }

    public function editDegrees($id) {
        $degrees = $this->degree->get($id);
        return view('admin.degree.edit_degree', compact('degrees'));
    }

    public function editDegreesPost(Request $request) {
        $data = $request->all();
        $degree = $this->degree->update($data);
        if($degree[0]['isSuccess'] === false){
            Notify::error($degree[0]['message']);
            return redirect()->back();
        }else{
            Notify::success($degree[0]['message']);
            return redirect()->back();
        }
    }

    public function markDegreeDisable(Request $request) {
        $data = $request->all();
        $degree = $this->degree->delete($data['id']);
        if ($degree['isSuccess'] === false){
            Notify::error($degree['message']);
            return redirect()->back();
        }else{
            Notify::success($degree['message']);
            return redirect()->back();
        }

    }

    public function getProgramme($id){
        $allProgrammes = $this->degree->get($id)->degree_programme;
//        return $allProgrammes;
        $programmes = array();
        foreach ($allProgrammes as $programme){
            if ($programme->status == 1){
                $programmes[] = $programme;
            }
        }
//        return $programmes;
        $programmeType = 'Active Programme';
        return view('admin.programme.all_programme_list', compact('programmes', 'programmeType'));
    }

    // Program Routes

    public function addprogrammeForm(){
        $degrees = $this->degree->all();
        return view('admin.programme.add_programme_form', compact('degrees'));
    }

    public function addprogrammePost(Request $request) {
        $data = $request->all();

        $programme = $this->programme->add($data);
        if($programme[0]['isSuccess'] === false ){
            Notify:: error($programme[0]['message']);
            return redirect()->back();
        }
        else {
            Notify::success($programme[0]['message']);
            return redirect()->back();
        }
    }

    public function getActiveProgrammes() {
        $programmes = $this->programme->getActive();
        $programmeType = 'Active Programme';
        return view('admin.programme.all_programme_list', compact('programmes','programmeType'));
    }

    public function editProgramme($id) {
        $programme = $this->programme->get($id);
        $degrees = $this->degree->all();
        return view('admin.programme.edit_programme', compact('degrees','programme'));
    }

    public function editProgrammePost(Request $request) {
        $data = $request->all();
        $programme = $this->programme->update($data);
        if($programme[0]['isSuccess'] === false){
            Notify::error($programme[0]['message']);
            return redirect()->back();
        }else{
            Notify::success($programme[0]['message']);
            return redirect()->back();
        }
    }

    public function markProgramDisable(Request $request){
        $data = $request->all();
        $programme = $this->programme->delete($data['id']);
        if ($programme['isSuccess'] === false){
            Notify::error($programme['message']);
            return redirect()->back();
        }else{
            Notify::success($programme['message']);
            return redirect()->back();
        }
    }

    public function  getDisabledProgrammes() {
        $programmes = $this->programme->getDisabled();
        $programmeType = 'Disabled Programme';
        return view('admin.programme.all_programme_list', compact('programmes','programmeType'));
    }

    public function getProgrammesByDegreeId($id){
        $programmes = $this->degree->getProgrammes($id);
        return json_encode($programmes);
    }

    public function getSubCategoriesByCategoryId($id){
        $subCategories = $this->category->get($id)->sub_categories;
        return json_encode($subCategories);
    } 

    public function editUserQualification(Request $request){
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

    public function editUserPortfolio(Request $request){
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
}

