<?php

namespace app\Repositories\Interfaces;

interface InterfaceRepository
{
    public function all($columns = array('*'));

    public function find($id, $columns = array('*'));

    public function findBy($field, $value, $operator = '=', $columns = array('*'));

    public function paginate($perPage = 15, $columns = array('*'));

    public function create(array $attributes);

    public function update(array $data, $column, $value, $operator = '=');

    public function updateAtID(array $data, $id);

    public function delete($id);
}