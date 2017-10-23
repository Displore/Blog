<?php

namespace Displore\Blog\Responses;

class CategoryPosts extends Response
{
    protected $view;
    protected $data;

    public function __construct($category, $posts)
    {
        $this->view = 'displore.blog::categoryposts.show';
        $this->data = [
            'category' => $category,
            'posts' => $posts
        ];
    }
}