<?php

namespace App\Models;

use app\Models\Traits\ValidationTrait;
use Illuminate\Database\Eloquent\Model;

class Actress extends Model
{
    use ValidationTrait;

    public static $namespace = 'App\Models\Actress';

    protected $table = "actresses";
    protected $guarded = ['id'];
    protected $fillable = [
        'name', 'alias', 'debut', 'measurements', 'dob', 'rate', 'note',
        'movie_count', 'image', 'thumbnail',
    ];
    /**
     * for ValidationTrait
     * @var array
     */
    protected static $rules = ['name' => 'bail|required|unique:actresses,name',
                                'dob' => 'date'];

    /**
     * Relationship
     */
    public function movies(){
        return $this->belongsToMany('App\Models\Movie', 'cast', 'actress_id', 'movie_id');
    }

    public function tags(){
        return $this->belongsToMany('App\Models\Tag', 'actress_tag', 'actress_id', 'tag_id');
    }
}
