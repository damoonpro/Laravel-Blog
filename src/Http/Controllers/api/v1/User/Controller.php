<?php

namespace Damoon\Blog\Http\Controllers\api\v1\User;

use App\Models\User;
use Damoon\Blog\Http\Controllers\BaseController;
use Damoon\Blog\Http\Requests\v1\Create as BlogRequest;
use Damoon\Blog\Http\Resources\v1\Collection as BlogCollection;
use Damoon\Blog\Http\Resources\v1\Single as SingleBlogView;
use Damoon\Blog\Models\Blog;
use Damoon\Blog\Models\BlogCategory;
use Damoon\Tools\Helpers;

class Controller extends BaseController
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

    public function update($blog, BlogRequest $request){
        $blog = $this->user()->blogs()->whereSlug($blog)->firstOrFail(); // users can update only them blogs

        $blog->update([
            'title' => $request->title,
            'description' => $request->description,
            'body' => $request->body,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'confirmed' => $blog->confirmed,
        ]);

        if(isset($request->categories)){
            $blog = $this->setCategories($blog, $request->categories);
        }

        return Helpers::responseWithMessage('وبلاگ با موفقیت ویرایش شد', [
            'blog' => [
                'slug' => $blog->slug,
            ]
        ]);
    }

    public function single($blog){
        $blog = $this->user()->blogs()->whereSlug($blog)->firstOrFail();

        return new SingleBlogView($blog, true);
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

    public function collect(){
        return new BlogCollection($this->user()->blogs()->paginate(9));
    }
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
