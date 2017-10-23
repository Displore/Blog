<?php

namespace Displore\Blog;

use Closure;
use Illuminate\Http\Request;

class Supervisor
{
    protected $authCallback;

    public function auth(Closure $callback)
    {
        return $this->authCallback = $callback;
    }

    public function check(Request $request)
    {
        return ($this->authCallback)($request);
    }
}