<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

class BaseRepository implements RepositoryInterface
{
    /**
     * @Model need to use in Repository
    */
    protected $model;

    /**
     * Inject @Model into BaseRepository by constructor
    */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all
     * @return mixed
     */
    public function index()
    {
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
        $result = $this->model->find($id);
        return $result;
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
            return $result;
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
