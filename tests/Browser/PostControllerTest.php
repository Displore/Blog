<?php

namespace Displore\Blog\Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\IntegrationTestCase;

class PostControllerTest extends IntegrationTestCase
{
    public function test_post_is_shown()
    {
        $post = $this->createHelloWorld();

        $this->browse(function (Browser $browser) {
            $browser->visitRoute('displore.blog::category.show', ['id' => 1])
                    ->assertSeeLink('Hello World')
                    ->clickLink('Hello World')
                    ->assertSee('Lorem ipsum dolor sit amet, consectetuer adipiscing elit.');
        });
    }

    public function test_creating_post()
    {
        factory(\Displore\Blog\Models\Category::class)->create([
            'id' => 1,
            'name' => 'My Posts'
        ]);

        $this->browse(function (Browser $browser) {
            $browser->visitRoute('displore.blog::post.create')
                    ->screenshot('test_creating_post_preSubmit')
                    ->type('title', 'Hello World')
                    ->type('excerpt', 'Lorem ipsum dolor sit amet')
                    ->type('content', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.')
                    ->select('category', '1')
                    ->select('published', '1')
                    ->screenshot('test_creating_post_formFilled')
                    ->press('Submit')
                    ->screenshot('test_creating_post_postSubmit')
                    // ->visitRoute('displore.blog::post.show', ['id' => 1])
                    ->assertSee('Hello World');
        });
    }

    public function test_category_cannot_be_null()
    {
        factory(\Displore\Blog\Models\Category::class)->create();

        $this->browse(function (Browser $browser) {
            $browser->visit('/blog/post/create')
                    ->type('title', 'Hello World')
                    ->type('excerpt', 'Lorem ipsum dolor sit amet')
                    ->type('content', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.')
                    ->select('published', '1')
                    ->press('Submit')
                    ->assertSee('The selected category is invalid');
        });
    }

    public function test_draft_cannot_be_seen()
    {
        # code...
    }

    public function test_draft_can_be_edited()
    {
        # code...
    }
}