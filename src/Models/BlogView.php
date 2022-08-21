<?php

namespace Damoon\Blog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogView extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'ip',
        'user_id',
        'blog_id',
    ];
}
