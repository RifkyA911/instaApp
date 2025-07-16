<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', // Pastikan user_id ada di fillable jika kamu menggunakannya
        'title',
        'content',
        // ... atribut lain
    ];

    /**
     * Mendefinisikan relasi many-to-one dengan model User.
     * Satu Post dimiliki oleh satu User.
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mendefinisikan relasi one-to-many dengan model Like.
     * Satu Post bisa memiliki banyak Like.
     */
    public function likes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Mendefinisikan relasi one-to-many dengan model Comment.
     * Satu Post bisa memiliki banyak Comment.
     */
    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
