<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'id_comment';
    public $timestamps = false;

    protected $fillable = [
        'isi_komentar',
        'user_id_user',
        'film_id_film'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id_user');
    }

    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id_film');
    }

    public function likes()
    {
        return $this->hasMany(CommentLike::class, 'comment_id', 'id_comment');
    }

    public function isLikedBy($userId): bool
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }
}
