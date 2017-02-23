<?php

namespace App\Models;

use app\Models\Traits\ValidationTrait;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use ValidationTrait;

    public static $namespace = 'App\Models\Series';
    public static $inCacheName = 'series_list';

    protected $table = 'series';
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'movie_count'
    ];

    /**
     * for ValidationTrait
     * @var array
     */
    protected static $rules = ['name' => 'bail|required|unique:series,name'];

    /**
     * Relationship
     */
    public function movies(){
        return $this->hasMany('App\Models\Movie', 'series_id');
    }

    /**
     * class method
     */

    /**
     * override method
     */
}
