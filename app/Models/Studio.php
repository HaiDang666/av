<?php

namespace App\Models;

use app\Models\Traits\ValidationTrait;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    use ValidationTrait;

    public static $namespace = 'App\Models\Studio';

    protected $table = "studios";
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'movie_count'
    ];
    protected static $rules = ['name' => 'bail|required|unique:studios,name'];

    /**
     * Relationship
     */
    public function movies(){
        return $this->hasMany('App\Models\Movie', 'studio_id');
    }

    /**
     * override method
     */
    public static function getRules()
    {
       return Studio::$rules;
    }
}
