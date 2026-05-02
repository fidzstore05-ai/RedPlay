<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $table = 'actors';
    protected $primaryKey = 'id_aktor';
    public $timestamps = false;

    protected $fillable = ['namaaktor'];

    public function films()
    {
        return $this->belongsToMany(Film::class, 'film_actor', 'aktor_idaktor', 'film_id_film');
    }
}