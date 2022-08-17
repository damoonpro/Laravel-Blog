<?php

namespace Damoon\Blog\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'label',
        'confirmed',
    ];

    public function blogs(){
        return $this->belongsToMany(Blog::class, 'blog_category',  'category_id', 'blog_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
