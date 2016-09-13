<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actress extends Model
{
    protected $table = "candidates";
    protected $fillable = [
        'name',
        'movie_count', 'image', 'thumbnail',
    ];
    protected $guarded = ['id'];

    /**
     * Relationship
     */
    public function movies(){
        return $this->belongsToMany('App\Models\Movie', 'cast', 'actress_id', 'movie_id');
    }
}
