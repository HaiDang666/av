<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    protected $table = "studios";
    protected $fillable = [
        'name',
        'movie_count'
    ];
    protected $guarded = ['id'];

    /**
     * Relationship
     */
    public function movies(){
        return $this->hasMany('App\Models\Movie', 'studio_id');
    }
}
