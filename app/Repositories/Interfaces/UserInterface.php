<?php
namespace App\Repositories\Interfaces;

interface UserInterface
{
    public function createOrUpdate();
    public function list($role);
}