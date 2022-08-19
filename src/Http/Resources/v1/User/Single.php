<?php

namespace Damoon\Blog\Http\Resources\v1\User;

use Damoon\Tools\Helpers;
use Illuminate\Http\Resources\Json\JsonResource;

class Single extends JsonResource
{
    public function toArray($request)
    {
        return Helpers::arrayPure([
            'name' => $this->name,
            'is_admin' => intval($this->is_admin()),
        ]);
    }

    public function with($request)
    {
        return ['status' => 'Success'];
    }
}
