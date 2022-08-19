<?php

namespace Damoon\Blog\Http\Controllers\api\v1\User;

use Damoon\Blog\Http\Controllers\BaseController;
use Damoon\Blog\Models\Blog;
use Damoon\Tools\Helpers;

class Controller extends BaseController
{
    public function like(Blog $blog){
        $like = $blog->likes()->whereUserId(auth()->user()->id);

        if($like->first()){
            $message = 'لایک شما با موفقیت حذف شد';
            $like->delete();
        }else{
            $message = 'لایک شما با موفقیت ثبت شد';
            $blog->likes()->create([
                'user_id' => auth()->user()->id,
                'like_at' => now(),
            ]);
        }

        return Helpers::responseWithMessage($message, [
            'blog' => [
                'slug' => $blog->slug,
            ]
        ]);
    }
}
