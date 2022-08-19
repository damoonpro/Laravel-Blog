<?php

namespace Damoon\Blog\Http\Controllers\api\v1\Admin\Category;

use Damoon\Blog\Http\Controllers\BaseController;
use Damoon\Blog\Http\Requests\v1\Admin\Category\Update as UpdateCategoryBlogRequest;
use Damoon\Blog\Http\Resources\v1\Category\Collection as CategoryCollection;
use Damoon\Blog\Models\BlogCategory;
use Damoon\Tools\Helpers;

class Controller extends BaseController
{
    public function collect(){
        return new CategoryCollection(BlogCategory::latest()->paginate(9));
    }

    public function update(BlogCategory $category, UpdateCategoryBlogRequest $request){
        // Admin shouldn't edit the category detail of other user
        $belongToMe = $category->user->id == auth()->user()->id;
        $message = $belongToMe ?
            'اطلاعات دسته‌بندی با موفقیت ویرایش شد' :
            'تنظیمات دسته‌بندی با موفقیت ویرایش شد';

        if($belongToMe){
            $category->update([
                'label' => $request->label,
                'confirmed' => $request->confirmed ?? $category->confirmed,
            ]);
        }
        else{
            $category->update([
                'confirmed' => $request->confirmed ?? $category->confirmed,
            ]);
        }
        return Helpers::responseWithMessage($message, [
            'category' => Helpers::arrayPure([
                'id' => $category->id,
                'confirmed' => $category->confirmed,
            ])
        ]);
    }
}
