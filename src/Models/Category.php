<?php

namespace Displore\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description', 'parent'];

    protected $casts = [
        'parent' => 'integer',
    ];

    public function posts()
    {
        return $this->hasMany('Displore\Blog\Models\Post');
    }

    public function children()
    {
        // return Category::whereParent($this->id)->get();
    }
}