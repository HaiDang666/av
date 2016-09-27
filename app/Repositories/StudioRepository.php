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

    public function delete($id)
    {
        $delete_studio = Studio::findOrFail($id);

        $movie = $delete_studio->movies()->first();
        if (!empty($movie)){
            throw new \Exception('Studio '. $delete_studio->name. ' has (a) movie.');
        }

        $delete_studio->delete();
        //$this->log();
        return $delete_studio;
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