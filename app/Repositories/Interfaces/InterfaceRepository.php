<?php

namespace app\Repositories\Interfaces;

interface InterfaceRepository
{
    public function all($columns = array('*'));

    public function find($id, $columns = array('*'));

    public function findBy($field, $value, $operator = '=', $columns = array('*'));

    public function paginate($perPage = 15, $columns = array('*'));

    public function create(array $attributes);

    public function update(array $attributes, $column, $value, $operator = '=');

    public function updateAtID($id, array $attributes);

    public function delete($id);
}