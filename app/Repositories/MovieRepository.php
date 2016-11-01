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

    public function updateAtID($id, array $attributes, array $options = [])
    {

        $oldActresses = json_decode($attributes['oldActresses']);
        $newActresses = [];
        if(isset($attributes['existActresses'])){
            $newActresses = $attributes['existActresses'];
            unset($attributes['existActresses']);
        }

        $tags = [];
        if(isset($attributes['tags'])){
            $tags = $attributes['tags'];
            unset($attributes['tags']);
        }

        DB::beginTransaction();
        try{
            // add movie
            $movie = parent::updateAtID($id, $attributes, $options);

            if($movie == NULL){
                throw new \Exception('Server error cannot update movie');
            }

            $movie->tags()->sync($tags);

            $syncFlag = true;
            $attach = array_diff($newActresses, $oldActresses);
            if(!empty($attach)){
                DB::table('actresses')
                    ->whereIn('id', $attach)
                    ->increment('movie_count');
                $syncFlag = false;
            }

            $detach = array_diff($oldActresses, $newActresses);
            if(!empty($detach)){
                DB::table('actresses')
                    ->whereIn('id', $detach)
                    ->decrement('movie_count');
                $syncFlag = false;
            }

            if($syncFlag === false){
                $movie->actresses()->sync($newActresses);
            }
        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }

        DB::commit();
        return $movie;
    }

    public function create(array $attributes, array $options = [])
    {
        $castList = [];
        $autoNameFlag = false;

        if(isset($attributes['existActresses'])){
            $existActresses = $attributes['existActresses'];
            unset($attributes['existActresses']);

            if (count($existActresses) == 1){
                $autoNameFlag = true;
            }
        }

        if(isset($attributes['newActresses'])){
            $newActresses = $attributes['newActresses'];
            unset($attributes['newActresses']);
            $autoNameFlag = false;
        }

        if(isset($attributes['tags'])){
            $tags = $attributes['tags'];
            unset($attributes['tags']);
        }

        DB::beginTransaction();
        try{
            //naming movie by actress's name
            if($attributes['name'] == ''){
                if($autoNameFlag){
                    $actress = Actress::where('id', '=', $existActresses[0])
                        ->select('name')
                        ->limit(1)
                        ->get();
                    $attributes['name'] = $actress[0]->name;
                }
            }

            // add movie
            $movie = parent::create($attributes, ['validation' => TRUE]);

            if($movie == NULL){
                throw new \Exception('Server error cannot create movie');
            }

            DB::table('studios')
                ->where('id', $attributes['studio_id'])
                ->increment('movie_count');

            // attach tags
            if(isset($tags)){
                $movie->tags()->sync($tags);
            }

            // attach existed actresses
            if(isset($existActresses)){
                $castList = $existActresses;
                DB::table('actresses')
                    ->whereIn('id', $existActresses)
                    ->increment('movie_count');
            }

            // create new actresses
            if(isset($newActresses)){
                $newList = [];
                foreach ($newActresses as $actress){
                    $new_actress = Actress::create(['name' => $actress, 'movie_count' => 1]);
                    if($new_actress == NULL){
                        throw new \Exception('Server error cannot create actress');
                    }
                    $newList[] =  $new_actress->id;
                }

                $castList = array_merge($castList, $newList);
            }

            $movie->actresses()->sync($castList);
        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }

        DB::commit();
        return $movie;
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
            $delete_movie->tags()->sync([]);
            $delete_movie->delete();
            //$this->log();
        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }

        DB::commit();
        return $delete_movie;
    }

    public function bannerMovies(){
        return Movie::inRandomOrder()
            ->select('image', 'code', 'name')
            ->limit(6)
            ->get();
    }

    public function latestMovies(){
        return Movie::select('id', 'code', 'name', 'note', 'rate', 'thumbnail', 'views')
            ->orderBy('release', 'desc')
            ->limit(18)
            ->get();
    }

    public function topViewedMovies(){
        return Movie::select('id', 'code', 'name', 'note', 'rate', 'thumbnail', 'views')
            ->orderBy('views', 'desc')
            ->limit(18)
            ->get();
    }

    public function topRatingMovies(){
        return Movie::select('id', 'code', 'name', 'note', 'rate', 'thumbnail', 'views')
            ->orderBy('rate', 'desc')
            ->limit(18)
            ->get();
    }

    public function recentlyAddedMovies(){
        return Movie::select('id', 'code', 'name', 'note', 'rate', 'thumbnail', 'views')
            ->orderBy('created_at', 'desc')
            ->limit(18)
            ->get();
    }

    public function todayMovies(){
        return Movie::inRandomOrder()
            ->select('id', 'code', 'name', 'rate', 'image', 'release', 'included', 'contain')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
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