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

    /**
     * Get resolved URL for the film thumbnail (poster).
     */
    public function getThumbnailUrlAttribute()
    {
        $value = $this->thumbnail;
        if (!$value) {
            return null;
        }

        if (filter_var($value, FILTER_VALIDATE_URL)) {
            if (str_contains($value, 'drive.google.com')) {
                if (preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $value, $matches)) {
                    return 'https://lh3.googleusercontent.com/d/' . $matches[1];
                } elseif (preg_match('/[?&]id=([a-zA-Z0-9_-]+)/', $value, $matches)) {
                    return 'https://lh3.googleusercontent.com/d/' . $matches[1];
                }
            }
            return $value;
        }

        return asset($value);
    }

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