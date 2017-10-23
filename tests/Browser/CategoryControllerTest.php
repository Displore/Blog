<?php

namespace Displore\Blog\Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\IntegrationTestCase;

class CategoryControllerTest extends IntegrationTestCase
{
    public function test_creating_category()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('displore.blog::category.create')
                    ->screenshot('test_creating_category_preSubmit')
                    ->type('name', 'General Greetings')
                    ->type('description', '1001 ways to say hello')
                    ->select('parent', '0')
                    ->press('Submit')
                    ->screenshot('test_creating_category_postSubmit')
                    ->assertSee('The category has been created')
                    ->visitRoute('displore.blog::blog.index')
                    ->assertSee('General Greetings');
        });
    }

    public function test_category_cannot_be_its_own_parent()
    {
    }
}
