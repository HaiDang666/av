<?php

namespace app\Repositories;

use app\Models\Tag;
use app\Repositories\BaseClasses\Repository;


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

    public function delete($id)
    {
        $delete_tag = Tag::findOrFail($id);

        $movie = $delete_tag->movies()->first();
        if (!empty($movie)){
            throw new \Exception('Tag '. $delete_tag->name. ' was used.');
        }

        $delete_tag->delete();
        //$this->log();
        return $delete_tag;
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