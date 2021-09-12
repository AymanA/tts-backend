<?php

namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface {

    public function insertOrIgnore(array $array);

    public function insert(array $data);

    public function all();

    public function create(array $data);

    public function createMultiple(array $data);

    public function delete();

    public function deleteById($id);

    public function deleteMultipleById(array $ids);

    public function first();

    public function get();

    public function getById($id);

    public function limit($limit);

    public function getModelFillable();

	public function orderBy($column, $direction = 'asc');

    public function updateById($id, array $data);

    public function where($column, $value, $operator = '=');

    public function whereIn($column, $value);

    public function with($relations);

    public function updateOrCreate(array $data, array $newData);

    }
