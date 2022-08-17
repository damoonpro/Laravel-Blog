<?php

namespace Damoon\Blog\Http\Resources\v1\Category;

use Damoon\Blog\Models\BlogCategory;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Collection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function (BlogCategory $category){
            $model = [
                'id' => $category->id,
                'label' => $category->label,
            ];

            return $model;
        });
    }

    public function with($request)
    {
        return ['status' => 'Success'];
    }
}
