<?php

namespace Displore\Blog\Tests\Http;

use Displore\Blog\Models\Post;
use Displore\Blog\Models\Category;
use Tests\FeatureTestCase;

class CategoryControllerTest extends FeatureTestCase
{
    public function test_GET_categories()
    {
        $this->dummyCategory();
        $response = $this->get(route('displore.blog::blog.index'));
        $response->assertViewHas('categories', [['id' => 1]]);
    }

    public function test_POST_category()
    {
        $response = $this->json('GET', route('displore.blog::category.store'), [
            'name' => 'General Greetings',
            'description' => '1001 ways to say hello',
            'parent' => '0'
        ]);

        $response->assertSuccessful();
    }
}