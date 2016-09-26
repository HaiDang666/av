<?php
/**
 * Created by PhpStorm.
 * User: Hoang Dang
 * Date: 9/26/2016
 * Time: 10:16 AM
 */

namespace app\Repositories;

use App\Models\Movie;
use app\Repositories\BaseClasses\Repository;

class MovieRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Movie::$namespace;
    }
}