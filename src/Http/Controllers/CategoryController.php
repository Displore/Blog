<?php

namespace Displore\Blog\Http\Controllers;

use Displore\Blog\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('displore.blog::categories.create', ['categories' => Category::all()]);
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
            'description' => 'required|max:255',
            'parent' => 'required|integer',
        ]);

        $category = Category::create($request->all());

        return redirect()->route('displore.blog::category.show', ['id' => $category->id])
            ->with('message', 'The category has been created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('displore.blog::categories.edit', [
            'category' => Category::findOrFail($id),
            'categories' => Category::all(),
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
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'parent' => 'required|integer',
        ]);

        Category::where('id', $id)->update($request->only('name', 'description', 'parent'));

        return redirect()->route('displore.blog::category.show', ['id' => $id])
            ->with('message', 'The category has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $string
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect(route('displore.blog::blog.index'))
            ->with('message', 'The category is gone!');
    }
}