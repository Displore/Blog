<?php

namespace Displore\Blog\Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\IntegrationTestCase;

class TagPostControllerTest extends IntegrationTestCase
{
    public function test_tag_shows_posts()
    {
        $post = $this->createHelloWorld();
        $post->tags()->save(factory(\Displore\Blog\Models\Tag::class)->create([
            'name' => 'greetings',
            'slug' => 'greetings',
        ]));

        $this->browse(function (Browser $browser) {
            $browser->visit('/blog/tag/greetings')
                    ->assertSee('Hello World');
        });
    }
}