<?php

namespace Damoon\Blog\Http\Resources\v1;

use Damoon\Blog\Http\Resources\v1\Category\Collection as CategoryCollection;
use Damoon\Blog\Http\Resources\v1\File\Collection as FileCollection;
use Damoon\Blog\Http\Resources\v1\User\Single as SingleUserView;
use Damoon\Tools\Helpers;
use Illuminate\Http\Resources\Json\JsonResource;

class Single extends JsonResource
{
    public function __construct($resource, protected $belongToMe = false)
    {
        parent::__construct($resource);
    }

    public function toArray($request)
    {
        $categories = $this->belongToMe ? $this->categories()->get() : $this->categories()->whereConfirmed(1)->get();

        $model = Helpers::arrayPure([
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'body' => $this->body,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'categories' => new CategoryCollection($categories),
            'user' => $this->belongToMe ? null  : new SingleUserView($this->user),
<<<<<<< HEAD
            'views' => $this->views()->count(),
            'likes' => $this->likes()->count(),
=======
            'files' => new FileCollection($this->files()->get()),
>>>>>>> file
        ]);

        return $model;
    }

    public function with($request)
    {
        return ['status' => 'Success'];
    }
}
