<?php


namespace App\Repositories;


use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepositoryImp extends BaseRepositoryImp implements UserRepositoryInterface
{
    /**
     * @Model UserResource
    */
    protected $model;

    /**
     * UserRepositoryImp Constructor
     * @param User model
    */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function showByUname($uname)
    {
        try {
            $result = $this->model->where('uname', $uname)->firstOrFail();
            return $result;
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => $exception->getMessage() ]);
        }
    }
}
