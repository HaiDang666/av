<?php

namespace App\Models;

use app\Models\Traits\ValidationTrait;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use ValidationTrait;

    public static $namespace = 'App\Models\Tag';
    public static $inCacheName = 'tag_list';

    protected $table = "tags";
    protected $fillable = [
        'name',
    ];
    protected $guarded = ['id'];

    /**
     * for ValidationTrait
     * @var array
     */
    protected static $rules = ['name' => 'bail|required|unique:tags,name'];

    /**
     * Relationship
     */
    public function movies(){
        return $this->belongsToMany('App\Models\Movie', 'tagged', 'tag_id', 'movie_id');
    }

    public function actresses(){
        return $this->belongsToMany('App\Models\Actress', 'actress_tag', 'tag_id', 'actress_id');
    }
}
