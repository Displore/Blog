<?php

namespace Displore\Blog\Tests\Unit;

use App\User;
use Displore\Blog\Models\Tag;
use Displore\Blog\Models\Post;
use Displore\Blog\Models\Category;
use Tests\UnitTestCase;

class PostTest extends UnitTestCase
{
    public function test_a_post_can_be_created()
    {
        $post = factory(Post::class)->create();
        $this->assertDatabaseHas('posts', $post->toArray());
    }

    public function test_relating_user_as_author_to_post()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create([
            'author_id' => $user->id,
        ]);
        $this->assertEquals($user->name, $post->author->name);
    }

    public function test_relating_post_to_category()
    {
        $category = factory(Category::class)->create();
        $post = factory(Post::class)->create([
            'category_id' => $category->id,
        ]);
        $this->assertEquals($category->name, $post->category->name);
    }

    public function test_relating_post_to_tags()
    {
        $post = factory(Post::class)->create();
        $tags = factory(Tag::class, 3)->create();
        $post->tags()->saveMany($tags);
        $this->assertEquals(
            $tags->keyBy('name')->keys()->toArray(),
            $post->tags->keyBy('name')->keys()->toArray()
        );
    }

    public function test_a_post_is_published()
    {
        $post = factory(Post::class)->create();
        $this->assertTrue($post->published);
        $this->assertTrue($post->isPublished());
    }

    public function test_a_post_is_unpublished()
    {
        $post = factory(Post::class)->create();
        $this->assertTrue($post->isPublished());
        $post->unpublish();
        $this->assertFalse($post->isPublished());
    }

    public function test_a_post_can_be_saved_as_draft()
    {
        $post = new Post;
        $post->author()->associate(factory(User::class)->create()->id);
        $post->category()->associate(factory(Category::class)->create()->id);
        $post->title = "Hello world!";
        $post->excerpt = "Hello";
        $post->content = "Lorem ipsum dolor sit amet";
        $post->saveDraft();

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'published' => false,
        ]);
    }

    public function test_a_post_is_saved_and_published()
    {
        $post = new Post;
        $post->author()->associate(factory(User::class)->create()->id);
        $post->category()->associate(factory(Category::class)->create()->id);
        $post->title = "Hello world!";
        $post->excerpt = "Hello";
        $post->content = "Lorem ipsum dolor sit amet";
        $post->saveAndPublish();

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'published' => true,
        ]);
    }

    public function test_get_all_leaves_out_drafts()
    {
        $postA = factory(Post::class)->create(['published' => false]);
        $postB = factory(Post::class)->create(['published' => true]);

        $this->assertEquals([$postB->toArray()], Post::all()->toArray());
    }

    public function test_only_retrieving_drafts()
    {
        $postA = factory(Post::class)->create(['published' => false]);
        $postB = factory(Post::class)->create(['published' => true]);

        $this->assertEquals([$postA->toArray()], Post::drafts()->get()->toArray());
    }

    public function test_retrieving_published_and_draft_posts()
    {
        $postA = factory(Post::class)->create(['published' => false]);
        $postB = factory(Post::class)->create(['published' => true]);

        $this->assertEquals([$postA->toArray(), $postB->toArray()], Post::withoutGlobalScope('published')->get()->toArray());
    }
}
