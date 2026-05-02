<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genres';
    protected $primaryKey = 'id_genre';
    public $timestamps = false;

    protected $fillable = ['genre'];

    public function films()
    {
        return $this->belongsToMany(Film::class, 'film_genre', 'genres_id_genre', 'film_id_film');
    }
}