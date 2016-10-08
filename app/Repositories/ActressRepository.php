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
use Illuminate\Support\Facades\DB;

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
        if(isset($attributes['tags'])){
            $tags = $attributes['tags'];
            unset($attributes['tags']);
        }

        DB::beginTransaction();
        try {
            $actress = parent::create($attributes, $options);

            if($actress == NULL){
                throw new \Exception('Server can not add actress');
            }

            // attach tags
            if(isset($tags)){
                foreach ($tags as $tag){
                    $actress->tags()->attach($tag);
                }
            }

        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }

        DB::commit();
        return $actress;
    }

    public function delete($id)
    {
        $detele_actress = Actress::findOrFail($id);

        $movie = $detele_actress->movies()->first();
        if (!empty($movie)){
            throw new \Exception('Actress  '. $detele_actress->name. ' casted (a) movie.');
        }

        DB::beginTransaction();
        try{
            $detele_actress->tags()->sync([]);
            $detele_actress->delete();

        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }
        DB::commit();

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