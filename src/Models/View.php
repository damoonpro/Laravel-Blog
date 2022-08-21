<?php

namespace Damoon\Blog\Models;

use Illuminate\Database\Eloquent\Builder;

class View
{
    public static function available(): Builder{
        return Blog::query()
            ->withCount('views')->orderBy('views_count', 'desc')
            ->withCount('likes')->orderBy('likes_count', 'desc')
            ->whereConfirmed(1)->latest();
    }
}
