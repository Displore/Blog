<?php

namespace Displore\Blog\Http\Controllers;

use Displore\Blog\Models\Tag;
use Illuminate\Http\Request;

class TagPostsController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $tag = Tag::with('posts')->slugOrFail($slug);

        return view('displore.blog::tagposts.show', ['tag' => $tag]);
    }
}