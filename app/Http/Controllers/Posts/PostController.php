<?php

namespace App\Http\Controllers\Posts;

use App\Article;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Article::with('category')->latest()->get();

        return PostResource::collection($posts);
    }

    public function store()
    {
        sleep(1);

        request()->validate([
            'category' => 'required|numeric',
            'title' => 'required|min:3',
            'description' => 'required',
        ]);

        $category = Category::findOrFail(request('category'));

        $article = Article::create([
            'category_id' => $category->id,
            'title' => request('title'),
            'slug' => Str::slug(request('title')),
            'description' => request('description')
        ]);

        return response()->json([
            'message' => 'Artikel berhasil di buat!',
            'article' => $article
        ]);
    }

    public function show(Article $post)
    {
        return PostResource::make($post);
    }

    public function update(Article $post)
    {
        sleep(1);
        
        request()->validate([
            'category' => 'required|numeric',
            'title' => 'required|min:3',
            'description' => 'required',
        ]);

        $category = Category::findOrFail(request('category'));

        $post->update([
            'category_id' => $category->id,
            'title' => request('title'),
            'description' => request('description')
        ]);

        return response()->json([
            'message' => 'Artikel berhasil di update!',
            'article' => $post
        ]);
    }

    public function destroy(Article $post)
    {
        $post->delete();

        return response()->json([
            'message' => 'Artikel berhasil di hapus!',
            'article' => $post
        ], 200);

    }
}
