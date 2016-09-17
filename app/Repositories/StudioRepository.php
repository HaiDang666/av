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

}