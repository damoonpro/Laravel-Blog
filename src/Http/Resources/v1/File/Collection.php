<?php

namespace Damoon\Blog\Http\Resources\v1\File;

use Damoon\Blog\Models\BlogFile;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Collection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function (BlogFile $file){
            $model = [
                'id' => $file->id,
                'url' => $file->url(),
            ];

            return $model;
        });
    }

    public function with($request)
    {
        return ['status' => 'Success'];
    }
}
