<?php

namespace Displore\Blog\Http\Controllers;

use Displore\Blog\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('displore.blog::tags.create');
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
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
        ]);

        $tag = new Tag;
        $tag->name = $request->name;
        $tag->slug = str_slug($request->slug);
        $tag->save();

        return redirect()->route('displore.blog::tag.show', ['slug' => $tag->slug])
            ->with('message', 'The tag has been created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return view('displore.blog::tags.edit', ['tag' => Tag::slugOrFail($slug)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
        ]);

        $tag->name = $request->name;
        $tag->slug = str_slug($request->slug);
        $tag->save();

        return redirect()->route('displore.blog::category.show', ['slug' => $slug])
            ->with('message', 'The category has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);

        $tag->delete();

        return redirect(route('displore.blog::blog.index'))
            ->with('message', 'The tag is gone!');
    }
}