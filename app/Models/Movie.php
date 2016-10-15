<?php

namespace App\Models;

use app\Models\Traits\ValidationTrait;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use ValidationTrait;

    public static $namespace = 'App\Models\Movie';

    protected $table = "movies";
    protected $fillable = [
        'name', 'code', 'rate', 'note', 'release',
        'studio_id', 'stored', 'length', 'included', 'contain',
        'image', 'thumbnail',
        'link'
    ];
    protected $guarded = ['id'];

    protected static $rules = ['code' => 'bail|required|unique:movies,code'];

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
