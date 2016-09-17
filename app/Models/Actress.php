<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actress extends Model
{
    static $namespace = 'App\Models\Actress';

    protected $table = "candidates";
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'movie_count', 'image', 'thumbnail',
    ];

    static $defaultValidation = null;

    /**
     * Relationship
     */
    public function movies(){
        return $this->belongsToMany('App\Models\Movie', 'cast', 'actress_id', 'movie_id');
    }
}
