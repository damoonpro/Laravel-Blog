<?php

namespace Damoon\Blog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogFile extends Model
{
    use HasFactory;

    protected $fillable = [
       'blog_id',
       'url',
    ];

    public function url(){
        return env('APP_URL').$this->url;
    }

    public function blog(){
        return $this->belongsTo(Blog::class);
    }
}
