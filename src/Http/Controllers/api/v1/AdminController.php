<?php

namespace Damoon\Blog\Http\Controllers\api\v1;

use Damoon\Blog\Http\Controllers\BaseController;
use Damoon\Blog\Http\Resources\v1\Collection as BlogCollection;
use Damoon\Blog\Models\Blog;

class AdminController extends BaseController
{
    public function collect(){
        return new BlogCollection(Blog::latest()->paginate(9), true);
    }
}
