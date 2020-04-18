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
    public function getProjectsByUserId($id);
    public function getCompletedProjectsByUserId($id);
    public function getUnAssignedProjects();
    public function getUserProjectsCount($id);
}
