<?php

namespace Damoon\Blog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeBlog extends Model
{
    use HasFactory;

    protected $table = 'like_blog';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'blog_id',
        'like_at',
    ];

    protected $casts = [
        'like_at' => 'datetime',
    ];
}
