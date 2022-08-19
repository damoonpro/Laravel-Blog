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
        $i_am_admin = (! is_null(auth()->user()) and auth()->user()->is_admin());

        return $this->collection->map(function (BlogCategory $category) use($i_am_admin){
            $confirmed = $i_am_admin ? ($category->confirmed ?? 0) : null;

            $model = Helpers::arrayPure([
                'id' => $category->id,
                'label' => $category->label,
                'user' => $i_am_admin ? new SingleUserView($category->user) : null,
                'confirmed' => $confirmed,
            ], sensitive: true);

            return $model;
        });
    }

    public function with($request)
    {
        return ['status' => 'Success'];
    }
}
