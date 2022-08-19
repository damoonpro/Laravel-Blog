<?php

namespace Damoon\Blog\Http\Controllers\api\v1\Admin\Category;

use Damoon\Blog\Http\Controllers\BaseController;
use Damoon\Blog\Http\Resources\v1\Category\Collection as CategoryCollection;
use Damoon\Blog\Models\BlogCategory;

class Controller extends BaseController
{
    public function collect(){
        return new CategoryCollection(BlogCategory::paginate(9));
    }
}
