<?php

namespace Damoon\Blog\Http\Controllers\api\v1;

use Damoon\Blog\Http\Controllers\BaseController;
use Damoon\Blog\Http\Resources\v1\Collection as BlogCollection;
use Damoon\Blog\Http\Resources\v1\Single as SingleBlogView;
use Damoon\Blog\Models\Blog;
use Damoon\Blog\Models\View;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    public function collect(){
        return new BlogCollection(View::available()->paginate(9));
    }

    public function single(Blog $blog){
        $this->addViewForBlog($blog);

        return new SingleBlogView($blog);
    }

    protected function addViewForBlog(Blog $blog, Request $request = null){
        if (! $request)
            $request = \request();

        if ($token = $request->bearerToken()) {
            $user = PersonalAccessToken::findToken($token)->first()->tokenable_id;

            // Don't set the ip here because every 72 hour ip change so maybe there throw an exception
            $blog->views()->firstOrCreate(['user_id' => $user]);
        } else {
            $blog->views()->firstOrCreate(['ip' => $request->ip()]);
        }
    }
}
