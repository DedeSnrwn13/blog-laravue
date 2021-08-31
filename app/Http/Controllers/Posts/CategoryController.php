<?php

namespace App\Http\Controllers\Posts;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::get();
    }
}
