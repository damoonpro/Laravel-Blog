<?php

namespace Damoon\Blog\Http\Controllers\api\v1;

use App\Models\User;
use Damoon\Blog\Http\Controllers\BaseController;
use Damoon\Blog\Http\Requests\v1\Create as BlogRequest;
use Damoon\Blog\Http\Requests\v1\File\Upload as UploadFileRequest;
use Damoon\Blog\Http\Resources\v1\Single as SingleBlogView;
use Damoon\Blog\Models\Blog;
use Damoon\Blog\Models\BlogCategory;
use Damoon\Blog\Models\BlogFile;
use Damoon\Tools\Helpers;
use Damoon\Tools\Storage\File;

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

    public function upload($blog, UploadFileRequest $request){
        $blog = $this->user()->blogs()->whereSlug($blog)->firstOrFail();

        $fileInfo = File::advancedUpload($request->file, 'blog');

        $file = $blog->files()->create([
            'url' => $fileInfo['url'],
        ]);

        return Helpers::responseWithMessage('بارگذاری فایل موفقیت آمیز بود', [
            'file' => [
                'url' => $file->url(),
            ]
        ]);
    }

    public function removeFile($blog, $file){
        $blog = Blog::whereSlug($blog)->firstOrFail();

        if($blog->user->id == auth()->user()->id){
            if($file = $blog->files()->whereId($file)->first()){
                $file->delete();

                return Helpers::responseWithMessage('حذف فایل موفقیت آمیز بود', [
                    'blog' => [
                        'slug' => $file->blog->slug,
                    ]
                ]);
            }
        }

        return Helpers::responseWithMessage('چنین فایلی وجود ندارد', [
            'file' => [
                'id' => $file,
            ]
        ]);
    }
}
