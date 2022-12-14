<?php

namespace Damoon\Blog\Http\Resources\v1;

use Damoon\Blog\Http\Resources\v1\Category\Collection as CategoryCollection;
use Damoon\Blog\Http\Resources\v1\File\Collection as FileCollection;
use Damoon\Blog\Http\Resources\v1\User\Single as SingleUserView;
use Damoon\Blog\Models\Blog;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Collection extends ResourceCollection
{
    public function __construct($resource, protected $belongToMe = false)
    {
        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return $this->collection->map(function (Blog $blog){
            $categories = $this->belongToMe ? $blog->categories()->get() : $blog->categories()->whereConfirmed(1)->get();

            $model = [
                'title' => $blog->title,
                'slug' => $blog->slug,
                'description' => $blog->description,
                'meta_title' => $blog->meta_title,
                'meta_description' => $blog->meta_description,
                'categories' => new CategoryCollection($categories),
                'user' => new SingleUserView($blog->user),
                'likes' => $blog->likes()->count(),
                'views' => $blog->views()->count(),
                'files' => new FileCollection($blog->files()->limit(3)->get()),
                'likes' => $blog->likes()->count(),
                'views' => $blog->views()->count(),
            ];

            return $model;
        });
    }

    public function with($request)
    {
        return ['status' => 'Success'];
    }
}
