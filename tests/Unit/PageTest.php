<?php

namespace Displore\Blog\Tests\Unit;

use App\User;
use Displore\Blog\Models\Tag;
use Displore\Blog\Models\Post;
use Displore\Blog\Models\Page;
use Displore\Blog\Models\Category;
use Tests\UnitTestCase;

class PageTest extends UnitTestCase
{
    public function test_a_page_can_be_created()
    {
        $page = factory(Page::class)->create();
        $this->assertDatabaseHas('posts', $page->toArray());
    }

    public function test_database_only_returns_pages()
    {
        $page = factory(Page::class)->create();
        factory(Post::class)->create();
        $this->assertEquals($page->toArray(), Page::find($page->id)->toArray());
    }
}
