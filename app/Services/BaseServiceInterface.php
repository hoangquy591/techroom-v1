<?php


namespace App\Services;


interface BaseServiceInterface
{
    /**
     * Get all
     * @return mixed
     */
    public function index($attributes = []);

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
