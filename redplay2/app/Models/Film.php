<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $table = 'films';
    protected $primaryKey = 'id_film';
    public $timestamps = false;

    protected $fillable = [
        'judul',
        'deskripsi',
        'tahun',
        'rating',
        'thumbnail',
        'video',
        'subtitle',
        'sutradara',
        'durasi',
    ];

    // Relasi ke Genre (many to many)
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'film_genre', 'film_id_film', 'genres_id_genre');
    }

    // Relasi ke Actor (many to many)
    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'film_actor', 'film_id_film', 'aktor_idaktor');
    }

    // Relasi ke Comment (one to many)
    public function comments()
    {
        return $this->hasMany(Comment::class, 'film_id_film');
    }
}