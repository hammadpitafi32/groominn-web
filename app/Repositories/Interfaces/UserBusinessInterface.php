<?php
namespace App\Repositories\Interfaces;

interface UserBusinessInterface
{
    public function createOrUpdate();
    public function getUserBusiness($id);
    public function createOrUpdateSchedule();
    public function createUserBusinessService();
}