<?php


namespace App\Services;


use App\Repositories\BaseRepositoryImp;
use App\Repositories\BaseRepositoryInterface;

class BaseServiceImp implements BaseServiceInterface
{
    /**
     * @Repository need to use in service
    */
    protected $repository;

    /**
     * Inject @Repository into BaseServiceImp by constructor
    */
    public function __construct(BaseRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all
     * @return mixed
     */
    public function index($attributes = [])
    {
        return $this->repository->index($attributes);
    }

    /**
     * Store
     * @param $attributes
     * @return mixed
     */
    public function store($attributes = [])
    {
        return $this->repository->store($attributes);
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->repository->show($id);
    }

    /**
     * Update
     * @param $id
     * @param $attributes
     * @return mixed
     */
    public function update($id, $attributes = [])
    {
        return $this->repository->update($id, $attributes);
    }

    /**
     * Destroy
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}
