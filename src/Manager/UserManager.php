<?php

namespace App\Manager;

use App\Repository\UserRepository;
use App\Entity\User;

class UserManager extends AbstractManager
{
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getClass()
    {
        return User::class;
    }
}