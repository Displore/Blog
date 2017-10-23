<?php

namespace Displore\Blog\Http\Controllers;

use Illuminate\Http\Request;
use Displore\Blog\Models\Post;
use Displore\Blog\Models\Category;
use Displore\Blog\Responses\CategoryPosts;

class CategoryPostsController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new CategoryPosts(Category::findOrFail($id), Post::where('category_id', $id)->get());
    }
}