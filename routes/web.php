<?php

// Blog frontpage
Route::get('/', 'HomeController@index')->name('blog.index');

// Categories
Route::get('category/create', 'CategoryController@create')->name('category.create');
Route::post('category/create', 'CategoryController@store')->name('category.store');
Route::get('category/{id}/edit', 'CategoryController@edit')->name('category.edit');
Route::put('category/{id}/edit', 'CategoryController@update')->name('category.update');
Route::delete('category/{id}', 'CategoryController@destroy')->name('category.delete');

// Posts within those categories
Route::get('category/{id}', 'CategoryPostsController@show')->name('category.show');

// Posts on their own
Route::get('post/create', 'PostController@create')->name('post.create');
Route::post('post/create', 'PostController@store')->name('post.store');
Route::get('post/{id}/edit', 'PostController@edit')->name('post.edit');
Route::put('post/{id}/edit', 'PostController@update')->name('post.update');
Route::delete('post/{id}', 'PostController@destroy')->name('post.delete');
Route::get('post/{id}', 'PostController@show')->name('post.show');

// Tags on their own
Route::get('tag/create', 'TagController@create')->name('tag.create');
Route::post('tag/create', 'TagController@store')->name('tag.store');
Route::get('tag/{slug}/edit', 'TagController@edit')->name('tag.edit');
Route::put('tag/{id}/edit', 'TagController@update')->name('tag.update');
Route::delete('tag/{id}', 'TagController@destroy')->name('tag.delete');

// Tags grouping posts together
Route::get('tag/{slug}', 'TagPostsController@show')->name('tag.show');

// Gotta Catch 'Em All
// Route::get('/{page?}', /*'PageController@show', */function ($page)
// {
//     return $page;
// })->where('page', '(.*)');
// Catch-left-overs that could be other post types
// Route::get('/{anything?}', 'PostTypeController@index');







Route::get('test', function() {

factory(Displore\Blog\Models\Post::class,5)->create();

    // $value = 'hallo';

    // dd($value);
});