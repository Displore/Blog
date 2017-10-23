<?php

namespace Displore\Blog\Http\Controllers;

use Illuminate\Http\Request;
use Displore\Blog\Models\Post;
use Displore\Blog\Models\User;
use Displore\Blog\Models\Category;

class PostController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('displore.blog::posts.create', ['categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'author' => 'required|integer',
            'title' => 'required|max:255',
            'excerpt' => 'required|max:255',
            'content' => 'required|max:255',
            'category' => 'required|not_in:0|integer',
            'published' => 'required|boolean',
        ]);

        $post = new Post;
        $post->author_id = User::findOrFail($request->author)->id;
        $post->title = $request->title;
        $post->excerpt = $request->excerpt;
        $post->content = $request->content;
        $post->category_id = Category::findOrFail($request->category)->id;
        $post->published = $request->published;
        $post->save();

        return redirect()->route('displore.blog::post.show', ['id' => $post->id])
            ->with('message', 'The post has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('displore.blog::posts.show', ['post' => Post::with('author')->findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('displore.blog::posts.edit', [
            'categories' => Category::all(),
            'post' => Post::everything()->findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'author' => 'required|integer',
            'title' => 'required|max:255',
            'excerpt' => 'required|max:255',
            'content' => 'required|max:255',
            'category' => 'required|not_in:0|integer',
            'published' => 'required|boolean',
        ]);

        $post->author_id = User::findOrFail($request->author)->id;
        $post->title = $request->title;
        $post->excerpt = $request->excerpt;
        $post->content = $request->content;
        $post->category_id = Category::findOrFail($request->category)->id;
        $post->published = $request->published;
        $post->save();

        return redirect()->route('displore.blog::post.edit', ['id' => $id])
            ->with('message', 'The post has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $string
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::everything()->findOrFail($id);

        $post->delete();

        return redirect(route('displore.blog::blog.index'))
            ->with('message', 'The post is gone!');
    }
}