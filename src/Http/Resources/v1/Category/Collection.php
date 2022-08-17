<?php

namespace Damoon\Blog\Http\Resources\v1\Category;

use Damoon\Blog\Http\Resources\v1\User\Single as SingleUserView;
use Damoon\Blog\Models\BlogCategory;
use Damoon\Tools\Helpers;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Collection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function (BlogCategory $category){
            $model = Helpers::arrayPure([
                'id' => $category->id,
                'label' => $category->label,
                'user' => (! is_null(auth()->user()) and auth()->user()->is_admin()) ? new SingleUserView($category->user) : null,
            ]);

            return $model;
        });
    }

    public function with($request)
    {
        return ['status' => 'Success'];
    }
}
