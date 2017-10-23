<?php

namespace Displore\Blog\Tests\Http;

use Displore\Blog\Models\Post;
use Displore\Blog\Models\Category;
use Tests\FeatureTestCase;

class CategoryPostsControllerTest extends FeatureTestCase
{
    public function test_category_shows_posts()
    {
        $this->createHelloWorld();
        $response = $this->json('GET', route('displore.blog::category.show', ['id' => 1]));
        $response->assertJson([
            'posts' => [[
                'title' => 'Hello World',
            ]]
        ]);
    }
}