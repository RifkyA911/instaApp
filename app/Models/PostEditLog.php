<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostEditLog extends Model
{
    protected $table = 'post_edit_logs';
    public $timestamps = false;

    protected $fillable = [
        'post_id',
        'user_id',
        'old_caption',
        'new_caption',
        'edited_at',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
