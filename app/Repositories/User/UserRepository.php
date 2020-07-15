<?php


namespace App\Repositories;


use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @Model User
    */
    protected $model;

    /**
     * UserRepository Constructor
     * @param User model
    */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

}
