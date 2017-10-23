<?php

namespace Displore\Blog\Tests\Feature;

use Displore\Blog\Facade;
use Tests\FeatureTestCase;

class AuthTest extends FeatureTestCase
{
    public function test_auth_callback()
    {
        Blog::auth(function ($request) {
            return $request === 'jeroen';
        });

        $this->assertTrue(Blog::check('jeroen'));
        $this->assertFalse(Blog::check('taylor'));
        $this->assertFalse(Blog::check(null));
    }

    /*public function test_authentication_middleware_can_pass()
    {
        Horizon::auth(function () {
            return true;
        });
        $middleware = new Authenticate;
        $response = $middleware->handle(
            new class {
            },
            function ($value) {
                return 'response';
            }
        );
        $this->assertSame('response', $response);
    }
    *
     * @expectedException \Symfony\Component\HttpKernel\Exception\HttpException
     
    public function test_authentication_middleware_responds_with_403_on_failure()
    {
        Horizon::auth(function () {
            return false;
        });
        $middleware = new Authenticate;
        $middleware->handle(
            new class {
            },
            function ($value) {
                return 'response';
            }
        );
    }*/
}