<?php
/**
 * Created by PhpStorm.
 * User: Hoang Dang
 * Date: 9/26/2016
 * Time: 10:16 AM
 */

namespace app\Repositories;

use App\Models\Actress;
use App\Models\Movie;
use app\Repositories\BaseClasses\Repository;
use Illuminate\Support\Facades\DB;


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

    public function create(array $attributes, array $options = [])
    {
        if(isset($attributes['newActresses'])){
            $newActresses = $attributes['newActresses'];
            unset($attributes['newActresses']);
        }

        if(isset($attributes['existActresses'])){
            $existActresses = $attributes['existActresses'];
            unset($attributes['existActresses']);
        }

        DB::beginTransaction();
        try{
            // add movie
            $movie = parent::create($attributes, ['validation' => TRUE]);

            if($movie == NULL){
                throw new \Exception('Server error cannot create movie');
            }

            DB::table('studios')
                ->where('id', $attributes['studio_id'])
                ->increment('movie_count');

            // attach existed actresses
            if(isset($existActresses)){
                foreach ($existActresses as $actress){
                    $movie->actresses()->attach($actress);
                }

                DB::table('actresses')
                    ->whereIn('id', $existActresses)
                    ->increment('movie_count');
            }

            // create new actresses
            if(isset($newActresses)){
                foreach ($newActresses as $actress){
                    $new_actress = Actress::create(['name' => $actress, 'movie_count' => 1]);
                    if($new_actress == NULL){
                        throw new \Exception('Server error cannot create movie');
                    }
                    // attach new actress
                    $movie->actresses()->attach($new_actress->id);
                }
            }
        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }

        DB::commit();
    }

    public function delete($id)
    {
        $delete_movie = Movie::findOrFail($id);

        DB::beginTransaction();
        try{
            $actresses = $delete_movie->actresses()->get(['id']);
            $actressesID = [];
            foreach ($actresses as $actress){
                $actressesID[] = $actress->id;
            }

            DB::table('studios')
                ->where('id', $delete_movie->studio_id)
                ->decrement('movie_count');

            if(!empty($actressesID)){
                DB::table('actresses')
                    ->whereIn('id', $actressesID)
                    ->decrement('movie_count');
            }

            $delete_movie->actresses()->sync([]);
            $delete_movie->delete();
            //$this->log();
        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }

        DB::commit();
        return $delete_movie;
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