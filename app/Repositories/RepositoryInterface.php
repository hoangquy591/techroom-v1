<?php


namespace App\Repositories;


interface RepositoryInterface
{
    /**
     * Get all
     * @return mixed
     */
    public function index();

    /**
     * Store
     * @param $attributes
     * @return mixed
     */
    public function store($attributes = []);

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function show($id);

    /**
     * Update
     * @param $id
     * @param $attributes
     * @return mixed
     */
    public function update($id, $attributes = []);

    /**
     * Destroy
     * @param $id
     * @return mixed
     */
    public function destroy($id);

}
