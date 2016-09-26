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

    public function create(array $attributes, array $options = [])
    {
        if (array_key_exists('validation', $options) && $options['validation'] == TRUE){
            $result = Actress::validate($attributes);
            if ($result !== TRUE){
                throw new \Exception($result);
            }
        }

        $new_actress = Actress::create($attributes);
        //$this->log();

        return $new_actress;
    }

    public function updateAtID($id, array $attributes, array $options = [])
    {
        if (array_key_exists('validation', $options) && $options['validation'] == TRUE){
            $result = Actress::validate($attributes);
            if ($result !== TRUE){
                throw new \Exception($result);
            }
        }

        $updated_actress = $this->find($id)->fill($attributes)->save();
        //$this->log();

        return $updated_actress;
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
}