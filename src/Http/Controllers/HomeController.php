<?php

namespace Displore\Blog\Http\Controllers;

use Illuminate\Http\Request;
use Displore\Blog\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        return view('displore.blog::frontpage', ['categories' => Category::all()]);
    }
}
