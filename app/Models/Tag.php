<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public static $namespace = 'App\Models\Tag';

    protected $table = "tags";
    protected $fillable = [
        'name',
    ];
    protected $guarded = ['id'];

    /**
     * Relationship
     */
    public function movies(){
        return $this->belongsToMany('App\Models\Movie', 'tagged', 'tag_id', 'movie_id');
    }
}
