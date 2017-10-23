<?php

namespace Displore\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts()
    {
        return $this->morphedByMany('Displore\Blog\Models\Post', 'taggable');
    }

    public function pages()
    {
        return $this->morphedByMany('Displore\Blog\Models\Page', 'taggable');
    }

    public function scopeSlugOrFail($query, $slug)
    {
        return $query->whereSlug($slug)->firstOrFail();
    }
}