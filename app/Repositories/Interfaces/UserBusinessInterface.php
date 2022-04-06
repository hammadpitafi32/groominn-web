<?php
namespace App\Repositories\Interfaces;

interface UserBusinessInterface
{
    public function createOrUpdate();
    public function createOrUpdateSchedule();
    public function createUserBusinessService();
}