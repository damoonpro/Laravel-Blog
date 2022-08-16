<?php

namespace Damoon\Blog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'label',
        'confirmed',
    ];

    public function blogs(){
        return $this->belongsToMany(Blog::class, 'blog_category', foreignPivotKey: 'category_id');
    }
}
