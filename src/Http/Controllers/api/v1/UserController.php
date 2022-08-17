<?php

namespace Damoon\Blog\Http\Controllers\api\v1;

use App\Models\User;
use Damoon\Blog\Http\Controllers\BaseController;
use Damoon\Blog\Http\Requests\v1\Create as BlogRequest;
use Damoon\Blog\Models\Blog;
use Damoon\Blog\Models\BlogCategory;
use Damoon\Tools\Helpers;

class UserController extends BaseController
{
    protected function user(): User{
        return auth()->user();
    }

    public function create(BlogRequest $request){
        $blog = $this->user()->blogs()->create([
            'title' => $request->title,
            'description' => $request->description,
            'body' => $request->body,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'confirmed' => $this->user()->is_admin() ? true : null,
        ]);

        if(isset($request->categories)){
            $blog = $this->setCategories($blog, $request->categories);
        }

        return Helpers::responseWithMessage('وبلاگ با موفقیت ثبت شد', [
            'blog' => [
                'slug' => $blog->slug,
            ]
        ]);
    }

    protected function setCategories(Blog $blog, array $categories){
        $result = [];

        foreach ($categories as $category) {
            if(is_string($category)){
                $category = BlogCategory::firstOrCreate(['label' => $category], [
                    'user_id' => $this->user()->id,
                    'confirmed' => $this->user()->is_admin(),
                ]);

                $result[] = $category->id;
            }
            else{
                $result[] = $category;
            }
        }

        $blog->categories()->sync($result);

        return $blog;
    }
}
