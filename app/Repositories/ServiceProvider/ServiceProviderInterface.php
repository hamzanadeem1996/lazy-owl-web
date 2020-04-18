<?php
namespace App\Repositories\ServiceProvider;

interface ServiceProviderInterface {
    public function add_services($data);
    public function delete_service($data);
}
