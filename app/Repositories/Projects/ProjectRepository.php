<?php
namespace App\Repositories\Projects;
use App\Projects;
use Illuminate\Support\Facades\Auth;
class ProjectRepository implements ProjectInterface {

    public function add($data)
    {
        $project = new Projects();
        $project->user_id           = $data['user_id'];
        $project->title             = $data['title'];
        $project->cat_id            = $data['cat_id'];
        $project->sub_cat_id        = $data['sub_cat_id'];
        $project->description       = $data['description'];
        $project->location          = $data['location'];
        $project->due_date          = $data['due_date'];
        $project->budget            = $data['budget'];
        $project->people_required   = $data['people_required'];

        if ($data['files'] != null) {
            $files = $data['files'];
            $destinationPath = 'images/project/';
            $categoryImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $categoryImage);
            $data['file'] = "$categoryImage";
            $project->media = $data['file'];
        }

        if ($project->save()){
            return $response = array(
              'isSuccess' => true,
              'status' => 200,
              'message' => 'Project added successfully'
            );
        }else{
            return $response = array(
                'isSuccess' => false,
                'status' => 500,
                'message' => 'Internal Server Error'
            );
        }
    }

    public function update($data)
    {
        $project = Projects::find($data['id']);
        $project->title             = $data['title'];
        $project->user_id           = $data['user_id'];
        $project->cat_id            = $data['cat_id'];
        $project->sub_cat_id        = $data['sub_cat_id'];
        $project->description       = $data['description'];
        $project->location          = $data['location'];
        $project->due_date          = $data['due_date'];
        $project->budget            = $data['budget'];
        $project->people_required   = $data['people_required'];

        if ($data['files'] != null) {
            $files = $data['files'];
            $destinationPath = 'images/project/';
            $categoryImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $categoryImage);
            $data['file'] = "$categoryImage";
            $project->media = $data['file'];
        }
        // else{
        //     $project->media = NULL;
        // }

        if ($project->save()){
            return $response = array(
                'isSuccess' => true,
                'status' => 200,
                'message' => 'Project updated successfully'
            );
        }else{
            return $response = array(
                'isSuccess' => false,
                'status' => 500,
                'message' => 'Internal Server Error'
            );
        }
    }

    public function get($id)
    {
        return $project = Projects::find($id);
    }

    public function completed()
    {
        return $projects = Projects::where('status', 1)->where('completed', 1)->get();
    }

    public function pending()
    {
        return $projects = Projects::where('status', 1)->where('completed', 0)->get();
    }

    public function getUnAssignedProjects()
    {
        return $projects = Projects::where('status', 1)->where('completed', 0)->where('assigned_to', null)->get();
    }

    public function discarded()
    {
        return $projects = Projects::where('status', 0)->get();
    }

    public function markComplete($id)
    {
        $project = Projects::find($id);
        if (isset($project)){
            $project->completed = 1;
            if ($project->save()){
                return $response = array(
                    'isSuccess' => true,
                    'message'   => 'Project updated successfully'
                );
            }else{
                return $response = array(
                    'isSuccess' => false,
                    'message'   => 'Internal Server Error'
                );
            }
        }else{
            return $response = array(
                'isSuccess' => false,
                'message'   => 'Project does not exists'
            );
        }
    }

    public function markDiscarded($id)
    {
        $project = Projects::find($id);
        if (isset($project)){
            $project->status = 0;
            if ($project->save()){
                return $response = array(
                    'isSuccess' => true,
                    'message'   => 'Project updated successfully'
                );
            }else{
                return $response = array(
                    'isSuccess' => false,
                    'message'   => 'Internal Server Error'
                );
            }
        }else{
            return $response = array(
                'isSuccess' => false,
                'message'   => 'Project does not exists'
            );
        }
    }

    public function markActive($id){
        $project = Projects::find($id);
        if (isset($project)){
            $project->status = 1;
            if ($project->save()){
                return $response = array(
                    'isSuccess' => true,
                    'message'   => 'Project updated successfully'
                );
            }else{
                return $response = array(
                    'isSuccess' => false,
                    'message'   => 'Internal Server Error'
                );
            }
        }else{
            return $response = array(
                'isSuccess' => false,
                'message'   => 'Project does not exists'
            );
        }
    }

    public function getCompletedProjectsByUserId($id){
        $userId = Auth::id();
        $userRole = Auth::user()->role;

        if ($userRole == 2){
            $projects = Projects::where('user_id', $userId)->where('status', 1)->where('completed', 1)->get();
        }else{
            $projects = Projects::where('assigned_to', $userId)->where('status', 1)->where('completed', 1)->get();
        }
        
        if (isset($projects)){
            return $response = array(
                'isSuccess' => true,
                'message'   => 'Success',
                'status'    => 200,
                'projects'  => $projects
            );
        }else{
            return $response = array(
                'isSuccess' => false,
                'message'   => 'Internal Server Error',
                'status'    => 500
            );
        }
    }

    public function getProjectsByUserId($id){
        $userId = Auth::id();
        $userRole = Auth::user()->role;

        if ($userRole == 2){
            $projects = Projects::where('user_id', $userId)->where('status', 1)->where('completed', 0)->get();
        }else{
            $projects = Projects::where('assigned_to', $userId)->where('status', 1)->where('completed', 0)->get();
        }
        
        if (isset($projects)){
            return $response = array(
                'isSuccess' => true,
                'message'   => 'Success',
                'status'    => 200,
                'projects'  => $projects
            );
        }else{
            return $response = array(
                'isSuccess' => false,
                'message'   => 'Internal Server Error',
                'status'    => 500
            );
        }
    }

    public function getDiscardedProjectsByUserId($id){
        $userId = Auth::id();
        $userRole = Auth::user()->role;
        
        if ($userRole == 2){
            $projects = Projects::where('user_id', $userId)->where('status', 0)->get();
        }else{
            $projects = Projects::where('assigned_to', $userId)->where('status', 0)->get();
        }
        
        if (isset($projects)){
            return $response = array(
                'isSuccess' => true,
                'message'   => 'Success',
                'status'    => 200,
                'projects'  => $projects
            );
        }else{
            return $response = array(
                'isSuccess' => false,
                'message'   => 'Internal Server Error',
                'status'    => 500
            );
        }
    }

    public function getUserProjectsCount($id){
        $projects = Projects::where('assigned_to', $id)->where('completed', 1)->count();
        return $projects;
    }
}
