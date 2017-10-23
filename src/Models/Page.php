<?php

namespace Displore\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Page extends Model
{
    protected $table = 'posts';
    
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', 'page');
        });
    }

    public function category()
    {
        return $this->morphToMany('Displore\Blog\Models\Category', 'classifiable');
    }

    public function tags()
    {
        return $this->morphToMany('Displore\Blog\Models\Tag', 'classifiable');
    }
}