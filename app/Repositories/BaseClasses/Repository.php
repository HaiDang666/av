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
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

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
        return $this->model->where($attribute, $operator, $value)->firstOrFail($columns);
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

        if (isset($option['select'])){
            $this->model->select($option['select']);
        }

        if (isset($option['order'])){
            $direction = 'asc';
            if (isset($option['order']['dir'])){
                $direction = $option['order']['dir'];
            }

            $this->model->orderBy($option['order']['col'], $direction);
        }

        if(isset($option['q'])){
            if (isset($option['q']['value'])){
                $value = $option['q']['value'];
                $field = $option['q']['field'];

                $this->model->where($field, 'like' ,'%'.$value)
                    ->orWhere($field, 'like' ,$value.'%')
                    ->orWhere($field, 'like' ,'%'.$value.'%');

            }

            if(isset($option['q']['stored'])){
                $this->model->where('stored', 1);
            }
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
            try{
                $result = $model::validate($attributes);
            }catch (\Exception $e){
                throw $e;
            }

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
            $object = $this->find($id);
            $object->fill($attributes)->save();
        }
        catch (\Exception $e){
            throw $e;
        }
        //$this->log();

        return $object;
    }

    /**
     * get data in form for select2 plugin with 2 column id,name
     * include get from cache
     *
     * @return mixed
     * @throws RepositoryException
     */
    public function allForSelect()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model){
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        $cacheName = null;
        if(isset($model::$inCacheName)){
            $cacheName = $model::$inCacheName;
        }

        if ($cacheName == null){
            return $this->model->get(['id', 'name']);
        }

        if (Cache::has($cacheName)) {
            return Cache::get($cacheName);
        }

        $data = $this->model->get(['id', 'name']);
        Cache::put($cacheName, $data, 60*24);
        return $data;
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

    public function addMissing($id, $name, $type){
        DB::table('missing')->insert(
            ['id' => $id, 'type' => $type, 'name' => $name]
        );
    }

    public function removeMissing($id, $type){
        DB::table('missing')
            ->where('id', '=', $id)
            ->where('type', '=', $type)
            ->take(1)
            ->delete();
    }

    public function checkMissing($id, $type){
        return DB::table('missing')
            ->where('id', $id)
            ->where('type', $type)
            ->limit(1)
            ->count();
    }

    public function getMissingList($type){
        return DB::table('missing')
            ->where('type', $type)
            ->get();
    }
}