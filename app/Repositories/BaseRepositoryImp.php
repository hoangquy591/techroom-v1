<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BaseRepositoryImp implements BaseRepositoryInterface
{
    /**
     * @Model need to use in Repository
    */
    protected $model;

    /**
     * Inject @Model into BaseRepositoryImp by constructor
    */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all
     * @return mixed
     */
    public function index($attributes = [])
    {
        if (sizeof($attributes) > 0) {
            return $this->model->with($attributes)->get();
        }
        return $this->model->all();
    }

    /**
     * Store
     * @param $attributes
     * @return mixed
     */
    public function store($attributes = [])
    {
        return $this->model->create($attributes);
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            $result = $this->model->findOrFail($id);
            return $result;
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => $exception->getMessage() ]);
        }
    }

    /**
     * Update
     * @param $id
     * @param $attributes
     * @return mixed
     */
    public function update($id, $attributes = [])
    {
        $result = $this->model->find($id);
        if ($result) {
            $result->update($attributes);
            return true;
        }
        return false;
    }

    /**
     * Destroy
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $result = $this->model->find($id);
        if ($result) {
            $result->delete();
            return true;
        }
        return false;
    }

}
