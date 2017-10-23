<?php

namespace Displore\Blog\Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\IntegrationTestCase;

class CategoryPostsControllerTest extends IntegrationTestCase
{
    public function test_category_shows_posts()
    {
        $this->createHelloWorld();

        $this->browse(function (Browser $browser) {
            $browser->visit('/blog/category/1')
                    ->assertSee('Hello World');
        });
    }

    public function test_category_only_shows_own_posts()
    {
        $category = factory(\Displore\Blog\Models\Category::class)->create();

        factory(\Displore\Blog\Models\Post::class)->create([
            'title' => 'Gutentag',
            'category_id' => $category->id,
        ]);

        factory(\Displore\Blog\Models\Post::class)->create([
            'title' => 'Bonjour',
            'category_id' => function() {
                return factory(\Displore\Blog\Models\Category::class)->create();
            },
        ]);

        $this->browse(function (Browser $browser) use ($category) {
            $browser->visit('/blog/category/'.$category->id)
                    ->assertSee('Gutentag')
                    ->assertDontSee('Bonjour');
        });
    }

    public function test_only_show_published_posts()
    {
        $category = factory(\Displore\Blog\Models\Category::class)->create();

        factory(\Displore\Blog\Models\Post::class)->create([
            'title' => 'Hello World',
            'category_id' => $category->id,
            'published' => false,
        ]);

        factory(\Displore\Blog\Models\Post::class)->create([
            'title' => 'Bonjour',
            'category_id' => $category->id,
            'published' => true,
        ]);

        $this->browse(function (Browser $browser) use ($category) {
            $browser->visit('/blog/category/'.$category->id)
                    ->assertSee('Bonjour')
                    ->assertDontSee('Hello World');
        });
    }
}
