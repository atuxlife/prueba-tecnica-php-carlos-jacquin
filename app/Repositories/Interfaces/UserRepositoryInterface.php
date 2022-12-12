<?php
namespace App\Repositories\Interfaces;

Interface UserRepositoryInterface
{    
    public function allUsers();
    public function storeUser($data);
    public function findUser($data);
    public function updateUser($data);
    public function loginUser($data);
    public function logoutUser($data);
}