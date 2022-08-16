<?php

namespace Damoon\Blog\Models;

use Illuminate\Database\Query\Builder;

class View
{
    public static function available(): Builder{
        return Blog::whereConfirmed(1)->latest();
    }
}
