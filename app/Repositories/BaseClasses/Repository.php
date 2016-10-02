<?php
/**
 * Created by PhpStorm.
 * User: Hoang Dang
 * Date: 9/16/2016
 * Time: 2:56 PM
 */

namespace app\Repositories\BaseClasses;

use app\Repositories\Interfaces\InterfaceRepository;
use Illuminate\Database\Eloquent\Model;
use app\Exceptions\RepositoryException;
use Illuminate\Container\Container as App;

/**
 * Class Repository
 * Manage all queries for get data of model
 *
 * @package app\Repositories\BaseClasses
 */
abstract class Repository implements InterfaceRepository
{
    private $app;

    protected $model;

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    abstract function model();

    /**
     * log all user's action on object
     *
     */
    abstract protected function log();

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * return the amount of record
     *
     * @return mixed
     * @throws RepositoryException
     */
    public function total(){
        $model = $this->app->make($this->model());

        if (!$model instanceof Model)
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $model::count();
    }

    /**
     * Get all objects of model
     *
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'))
    {
        return $this->model->get($columns);
    }

    /**
     * Find object by id
     *
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        return $this->model->findOrFail($id, $columns);
    }

    /**
     * Get first object by an attribute
     *
     * @param $attribute
     * @param $value
     * @param string $operator
     * @param array $columns
     * @return mixed
     */
    public function findBy($attribute, $value, $operator = '=', $columns = array('*'))
    {
        return $this->model->where($attribute, $operator, $value)->first($columns);
    }

    /**
     * Get object with paginate
     *
     * @param int $perPage
     * @param array $option
     * @return mixed
     */
    public function paginate($perPage = 15, $option = [])
    {
        $this->makeModel();

        if (isset($option['order'])){
            $direction = 'asc';
            if (isset($option['order']['dir'])){
                $direction = $option['order']['dir'];
            }

            $this->model->orderBy($option['order']['col'], $direction);
        }

        return $this->model->paginate($perPage);
    }

    /**
     * Create new object
     *
     * @param array $attributes
     * @param array $options
     * @return mixed
     * @throws RepositoryException
     * @throws \Exception
     */
    public function create(array $attributes, array $options = [])
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model)
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        if (array_key_exists('validation', $options) && $options['validation'] == TRUE){
            $result = $model::validate($attributes);
            if ($result !== TRUE){
                throw new \Exception($result);
            }
        }

        $object = $model::create($attributes);
        //$this->log();

        return $object;
    }

    /**
     * Update object's attributes by column condition
     *
     * @param array $attributes
     * @param $column
     * @param $value
     * @param string $operator
     * @return mixed
     */
    public function update(array $attributes, $column, $value, $operator = "=")
    {
        return $this->model->where($column, $operator, $value)->update($attributes);
    }

    /**
     * Update object's attributes by id
     *
     * @param $id
     * @param array $attributes
     * @param array $options
     * @return mixed
     * @throws RepositoryException
     * @throws \Exception
     */
    public function updateAtID($id, array $attributes, array $options = [])
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model)
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        if (array_key_exists('validation', $options) && $options['validation'] == TRUE){
            $unique = [];
            if (array_key_exists('unique', $options)){
                $unique = $options['unique'];
            }
            $result = $model::validate($attributes, $unique);
            if ($result !== TRUE){
                throw new \Exception($result);
            }
        }

        try{
            $object = $this->find($id)->fill($attributes)->save();
        }
        catch (\Exception $e){
            throw $e;
        }
        //$this->log();

        return $object;
    }

    /**
     * Destroy object by id
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * Init model for repository
     *
     * @return \Illuminate\Database\Eloquent\Builder
     * @throws RepositoryException
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model)
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->model = $model->newQuery();
    }

    /**
     * Get model of current repository
     *
     * @return mixed
     */
    public function getModel() {
        return $this->model->getModel();
    }

    public function validateModel(array $attributes, array $validation = NULL)
    {
        return $this->getModel()->validateModel($attributes, $validation);
    }

    public function getDefaultValidation()
    {
        return $this->getModel()->getDefaultValidation();
    }
}