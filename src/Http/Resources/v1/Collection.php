<?php

namespace Damoon\Blog\Http\Resources\v1;

use Damoon\Blog\Models\Blog;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Collection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function (Blog $blog){
            $model = [
                'title' => $blog->title,
                'description' => $blog->description,
                'meta_title' => $blog->meta_title,
                'meta_description' => $blog->meta_description,
            ];

            return $model;
        });
    }

    public function with($request)
    {
        return ['status' => 'Success'];
    }
}
