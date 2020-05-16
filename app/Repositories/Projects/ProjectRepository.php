<?php
namespace App\Repositories\Projects;
use App\Projects;
use App\ProjectQueries;
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
              'message' => 'Project added successfully',
              'project' => $project
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
                'message' => 'Project updated successfully',
                'project'  => $project
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

    public function getUnAssignedProjects($offset = null, $limit = null)
    {
        if ($offset && $limit){
            return $projects = Projects::where('status', 1)->where('completed', 0)->where('assigned_to', null)->offset($offset)->limit($limit)->get();
        } else {
            return $projects = Projects::where('status', 1)->where('completed', 0)->where('assigned_to', null)->get();
        }
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
                    'status'    => 200,
                    'isSuccess' => true,
                    'message'   => 'Project marked completed successfully'
                );
            }else{
                return $response = array(
                    'status'    => 500,
                    'isSuccess' => false,
                    'message'   => 'Internal Server Error'
                );
            }
        }else{
            return $response = array(
                'status'    => 400,
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
                    'status'    => 200,
                    'isSuccess' => true,
                    'message'   => 'Project discarded successfully'
                );
            }else{
                return $response = array(
                    'status'    => 500,
                    'isSuccess' => false,
                    'message'   => 'Internal Server Error'
                );
            }
        }else{
            return $response = array(
                'status'    => 400,
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

    public function getCompletedProjectsByUserId($id, $userRole, $offset = null, $limit = null){
        if ($offset && $limit) {
            if ($userRole == 2){
                $projects = Projects::where('user_id', $id)->where('status', 1)->where('completed', 1)->offset($offset)->limit($limit)->get();
            }else{
                $projects = Projects::where('assigned_to', $id)->where('status', 1)->where('completed', 1)->offset($offset)->limit($limit)->get();
            }
         } else {
            if ($userRole == 2){
                $projects = Projects::where('user_id', $id)->where('status', 1)->where('completed', 1)->get();
            }else{
                $projects = Projects::where('assigned_to', $id)->where('status', 1)->where('completed', 1)->get();
            }
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

    public function getProjectsByUserId($id, $userRole, $offset = null, $limit = null){
        if ($offset && $limit) {
            if ($userRole == 2){
                $projects = Projects::where('user_id', $id)->where('status', 1)->where('completed', 0)->offset($offset)->limit($limit)->get();
            }else{
                $projects = Projects::where('assigned_to', $id)->where('status', 1)->where('completed', 0)->offset($offset)->limit($limit)->get();
            }
        } else {
            if ($userRole == 2){
                $projects = Projects::where('user_id', $id)->where('status', 1)->where('completed', 0)->get();
            }else{
                $projects = Projects::where('assigned_to', $id)->where('status', 1)->where('completed', 0)->get();
            }
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

    public function getAssignedProjectsByUserId($userId){
        return Projects::where('user_id', $userId)->where('status', 1)->where('completed', 0)->where('assigned_to', '!=', null)->get();
    }

    public function getDiscardedProjectsByUserId($id, $userRole, $offset = null, $limit = null){
        if ($offset && $limit) {
            if ($userRole == 2){
                $projects = Projects::where('user_id', $id)->where('status', 0)->offset($offset)->limit($limit)->get();
            }else{
                $projects = Projects::where('assigned_to', $id)->where('status', 0)->offset($offset)->limit($limit)->get();
            }
        } else {
            if ($userRole == 2){
                $projects = Projects::where('user_id', $id)->where('status', 0)->get();
            }else{
                $projects = Projects::where('assigned_to', $id)->where('status', 0)->get();
            }
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

    public function getConsultantProjects($id, $offset = null, $limit = null){
        $projects = array();
        if ($offset && $limit) {
            $projects['active_projects']    = Projects::where('assigned_to', $id)->where('status', 1)->where('completed', 0)->offset($offset)->limit($limit)->get();
            $projects['posted_projects']    = Projects::where('user_id', $id)->where('status', 1)->where('completed', 0)->offset($offset)->limit($limit)->get();
            $projects['discarded_projects'] = Projects::where('user_id', $id)->where('status', 0)->where('completed', 0)->offset($offset)->limit($limit)->get();
            $projects['completed_projects']['assigned'] = Projects::where('assigned_to', $id)->where('status', 1)->where('completed', 1)->offset($offset)->limit($limit)->get();
            $projects['completed_projects']['posted'] = Projects::where('user_id', $id)->where('status', 1)->where('completed', 1)->offset($offset)->limit($limit)->get();
        } else {
            $projects['active_projects']    = Projects::where('assigned_to', $id)->where('status', 1)->where('completed', 0)->get();
            $projects['posted_projects']    = Projects::where('user_id', $id)->where('status', 1)->where('completed', 0)->get();
            $projects['discarded_projects'] = Projects::where('user_id', $id)->where('status', 0)->where('completed', 0)->get();
            $projects['completed_projects']['assigned'] = Projects::where('assigned_to', $id)->where('status', 1)->where('completed', 1)->get();
            $projects['completed_projects']['posted'] = Projects::where('user_id', $id)->where('status', 1)->where('completed', 1)->get();
        }
        
        return $projects;
    }

    public function addProjectQuery($data){
        $query = new ProjectQueries();
        $query->user_id = $data['user_id'];
        $query->project_id = $data['project_id'];
        $query->query = $data['query'];
        if ($query->save()){
            return $response = array(
                'isSuccess' => true,
                'message'   => 'Query submitted Successfully',
                'status'    => 200
            );
        }else{
            return $response = array(
                'isSuccess' => false,
                'message'   => 'Internal Server Error',
                'status'    => 500
            );
        }
    }

    public function getProjectQueries() {
        return ProjectQueries::where('status', 1)->get();
    }

    public function markQueryAnswered($id){
        $query = ProjectQueries::find($id);
        $query->is_answered = 1;
        
        if ($query->save()){
            return $response = array(
                'isSuccess' => true,
                'message'   => 'Query Answered Successfully',
                'status'    => 200
            );
        }else{
            return $response = array(
                'isSuccess' => false,
                'message'   => 'Internal Server Error',
                'status'    => 500
            );
        }
    }

    public function searchProjects($title, $offset = null, $limit = null) {
        if ($offset && $limit){
            return Projects::where('title', 'LIKE', '%'.$title.'%')->offset($offset)->limit($limit)->get();
        } else {
            return Projects::where('title', 'LIKE', '%'.$title.'%')->get();
        }
    }
}
