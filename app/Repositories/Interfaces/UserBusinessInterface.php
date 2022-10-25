<?php
namespace App\Repositories\Interfaces;

interface UserBusinessInterface
{
    public function createOrUpdate();
    public function getUserBusiness($id);
    public function deleteUserBusiness($id);
    public function createOrUpdateSchedule();
    public function createUserBusinessService();
    public function deleteUserCategoryService($id);

    public function getBusinesseslist();
    public function deleteBusinessImage();
    
    public function changeStatus();
}