<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentEditLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'comment_id',
        'user_id',
        'old_content',
        'new_content',
        'edited_at',
    ];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
