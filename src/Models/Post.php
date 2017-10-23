<?php

namespace Displore\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    protected $fillable = ['author_id', 'category', 'title', 'excerpt', 'content', 'type', 'published'];

    protected $casts =[
        'published' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', 'post');
        });

        static::addGlobalScope('published', function (Builder $builder) {
            $builder->where('published', true);
        });
    }

    public function author()
    {
        return $this->belongsTo('Displore\Blog\Models\User');
    }

    public function category()
    {
        return $this->belongsTo('Displore\Blog\Models\Category');
    }

    public function tags()
    {
        return $this->morphToMany('Displore\Blog\Models\Tag', 'taggable');
    }

    public function isPublished()
    {
        return $this->published;
    }

    public function publish()
    {
        $this->published = true;
        return $this;
    }

    public function unpublish()
    {
        $this->published = false;
        return $this;
    }

    public function saveDraft()
    {
        return $this->unpublish()->save();
    }

    public function saveAndPublish()
    {
        return $this->publish()->save();
    }

    public function scopeDrafts($query)
    {
        return $query->withoutGlobalScope('published')->where('published', false);
    }

    public function scopeEverything($query)
    {
        return $query->withoutGlobalScope('published');
    }
}