<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    static $namespace = 'App\Models\Movie';

    protected $table = "movies";
    protected $fillable = [
        'name', 'code',
        'studio_id', 'stored',
        'image', 'thumbnail',
    ];
    protected $guarded = ['id'];

    /**
     * Relationship
     */
    public function actresses(){
        return $this->belongsToMany('App\Models\Actress', 'cast', 'movie_id', 'actress_id');
    }

    public function studio(){
        return $this->belongsTo('App\Models\Studio', 'studio_id');
    }

    public function tags(){
        return $this->belongsToMany('App\Models\Tag', 'tagged', 'movie_id', 'tag_id');
    }
}
