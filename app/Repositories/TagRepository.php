<?php

namespace app\Repositories;

use app\Models\Tag;
use app\Repositories\BaseClasses\Repository;
use Illuminate\Support\Facades\Cache;


class TagRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Tag::$namespace;
    }

    public function create(array $attributes, array $options = [])
    {
        $this->flush();
        return parent::create($attributes, $options);
    }

    public function updateAtID($id, array $attributes, array $options = [])
    {
        $this->flush();
        return parent::updateAtID($id, $attributes, $options);
    }

    public function delete($id)
    {
        $delete_tag = Tag::findOrFail($id);

        $movie = $delete_tag->movies()->first();
        if (!empty($movie)){
            throw new \Exception('Tag '. $delete_tag->name. ' was used.');
        }

        $this->flush();
        $delete_tag->delete();
        //$this->log();
        return $delete_tag;
    }

    protected function flush(){
        Cache::forget(Tag::$inCacheName);
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