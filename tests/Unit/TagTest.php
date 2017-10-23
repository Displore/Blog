<?php

namespace Displore\Blog\Tests\Unit;

use Displore\Blog\Models\Tag;
use Displore\Blog\Models\Post;
use Tests\UnitTestCase;

class TagTest extends UnitTestCase
{
    public function test_a_tag_can_be_created()
    {
        $tag = factory(Tag::class)->create();
        $this->assertDatabaseHas('tags', $tag->toArray());
    }
}