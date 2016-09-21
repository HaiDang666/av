<?php
/**
 * Created by PhpStorm.
 * User: Hoang Dang
 * Date: 9/17/2016
 * Time: 10:39 AM
 */

namespace app\Repositories;

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

    /**
     * Create new object
     *
     * @param array $attributes
     * @param array $options
     * @return mixed
     * @throws \Exception if fail validation
     */
    public function create(array $attributes, array $options = [])
    {

        if (array_key_exists('validation', $options) && $options['validation'] == TRUE){
            $result = Studio::validate($attributes);
            if ($result !== TRUE){
                throw new \Exception($result);
            }
        }

        $new_studio = Studio::create($attributes);
        $this->log();

        return $new_studio;
    }

    /**
     * log all user's action on studio object
     *
     */
    protected function log(){
       // TODO: log action
    }
}