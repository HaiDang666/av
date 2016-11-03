<?php
/**
 * Created by PhpStorm.
 * User: Hoang Dang
 * Date: 9/17/2016
 * Time: 10:39 AM
 */

namespace app\Repositories;

use app\Models\Series;
use app\Repositories\BaseClasses\Repository;
use Illuminate\Support\Facades\Cache;


class SeriesRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Series::$namespace;
    }

    public function create(array $attributes, array $options = [])
    {
        $this->flush();
        return parent::create($attributes, $options);
    }

    public function updateAtID($id, array $attributes, array $options = [])
    {
        $this->flush();
        return parent::updateAtID($id, $attributes, $options);
    }

    public function delete($id)
    {
        $delete_series = Series::findOrFail($id);

        $movie = $delete_series->movies()->first();
        if (!empty($movie)){
            throw new \Exception('Series '. $delete_series->name. ' has (a) movie.');
        }

        $this->flush();
        $delete_series->delete();
        //$this->log();
        return $delete_series;
    }

    protected function flush(){
        Cache::forget(Series::$inCacheName);
    }

    /**
     * log all user's action on object
     *
     */
    protected function log()
    {
        // TODO: Implement log() method.
    }
}