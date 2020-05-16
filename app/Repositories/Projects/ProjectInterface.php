<?php
namespace App\Repositories\Projects;

interface ProjectInterface {

    public function add($data);
    public function update($data);
    public function get($id);
    public function completed();
    public function pending();
    public function discarded();
    public function markComplete($id);
    public function markDiscarded($id);
    public function markActive($id);
    // public function getProjectsByUserId($id, $role, $offset = null, $limit = null);
    // public function getCompletedProjectsByUserId($id, $role, $offset = null, $limit = null);
    // public function getUnAssignedProjects($offset = null, $limit = null);
    public function getUserProjectsCount($id);
    // public function getConsultantProjects($id, $offset = null, $limit = null);
    public function addProjectQuery($data);
}
