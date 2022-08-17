<?php

namespace Damoon\Blog\Models;

use Database\Factories\BlogFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Pishran\LaravelPersianSlug\HasPersianSlug;
use Spatie\Sluggable\SlugOptions;

class Blog extends Model
{
    use HasFactory, HasPersianSlug;

    public static function factory($count = null, $state = [])
    {
        return new BlogFactory($count);
    }

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'body',
        'meta_title',
        'meta_description',
        'confirmed',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function categories(){
        return $this->belongsToMany(BlogCategory::class, 'blog_category', 'blog_id', 'category_id');
    }
}
