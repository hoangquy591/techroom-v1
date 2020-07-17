<?php


namespace App\Services\User;


use App\Repositories\User\UserRepositoryInterface;
use App\Services\BaseServiceImp;

class UserServiceImp extends BaseServiceImp implements UserServiceInterface
{
    /**
     * @Repository UserRepository
     */
    protected $repository;

    /**
     * UserServiceImp Constructor
     * @param UserRepositoryInterface repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }
}
