<?php

namespace Displore\Blog\Tests\Unit;

use Displore\Blog\Models\Post;
use Displore\Blog\Models\Category;
use Tests\UnitTestCase;

class CategoryTest extends UnitTestCase
{
    public function test_a_category_can_be_created()
    {
        $category = factory(Category::class)->create();
        $this->assertDatabaseHas('categories', $category->toArray());
    }

    public function test_relating_category_to_posts()
    {
        $category = factory(Category::class)->create();
        $post = factory(Post::class)->create();
        $category->posts()->save($post);
        $this->assertDatabaseHas('posts', $post->toArray());
        $this->assertEquals($post->category->id, $category->id);
    }

    public function test_parent_and_children_categories()
    {
        $parent = factory(Category::class)->create();
        $children = factory(Category::class, 2)->create(['parent' => $parent->id]);

        $this->assertEquals($parent->id, $children->first()->parent);
    }
}