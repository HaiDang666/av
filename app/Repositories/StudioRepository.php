<?php
/**
 * Created by PhpStorm.
 * User: Hoang Dang
 * Date: 9/17/2016
 * Time: 10:39 AM
 */

namespace app\Repositories;

use App\Models\Movie;
use app\Models\Studio;
use app\Repositories\BaseClasses\Repository;


class StudioRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Studio::$namespace;
    }

    public function create(array $attributes, array $options = [])
    {
        if (array_key_exists('validation', $options) && $options['validation'] == TRUE){
            $result = Studio::validate($attributes);
            if ($result !== TRUE){
                throw new \Exception($result);
            }
        }

        $new_studio = Studio::create($attributes);
        //$this->log();

        return $new_studio;
    }

    public function updateAtID($id, array $attributes, array $options = [])
    {
        if (array_key_exists('validation', $options) && $options['validation'] == TRUE){
            $result = Studio::validate($attributes);
            if ($result !== TRUE){
                throw new \Exception($result);
            }
        }

        $updated_studio = $this->find($id)->fill($attributes)->save();
        //$this->log();

        return $updated_studio;
    }

    public function delete($id)
    {
        $delete_studio = Studio::findOrFail($id);

        $movie = Movie::where('studio_id', $delete_studio->id)->first();
        if (!empty($movie)){
            throw new \Exception('Studio '. $delete_studio->name. ' has (a) movie.');
        }

        $delete_studio->delete();
        return $delete_studio;
    }

    /**
     * log all user's action on studio object
     *
     */
    protected function log(){
       // TODO: log action
    }
}