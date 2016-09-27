<?php
/**
 * Created by PhpStorm.
 * User: Hoang Dang
 * Date: 9/23/2016
 * Time: 11:25 AM
 */

namespace app\Repositories;

use App\Models\Actress;
use app\Repositories\BaseClasses\Repository;

class ActressRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Actress::$namespace;
    }

    public function delete($id)
    {
        $detele_actress = Actress::findOrFail($id);

        $movie = $detele_actress->movies()->first();
        if (!empty($movie)){
            throw new \Exception('Actress  '. $detele_actress->name. ' casted (a) movie.');
        }

        $detele_actress->delete();
        //$this->log();
        return $detele_actress;
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