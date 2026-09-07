<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('categoria');
        $search = $request->query('busca');

        $query = Post::published();

        if ($category && $category !== 'todos') {
            $query->where('category', $category);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('tags', 'like', "%{$search}%");
            });
        }

        $posts = $query->orderBy('published_at', 'desc')
            ->paginate(6)
            ->withQueryString();

        $categories = Post::published()->distinct()->pluck('category')->filter();
        $recentPosts = Post::published()->orderBy('published_at', 'desc')->take(4)->get();

        return view('blog.index', compact('posts', 'categories', 'category', 'search', 'recentPosts'));
    }

    public function show(string $slug)
    {
        $post = Post::published()
            ->where('slug', $slug)
            ->firstOrFail();

        $post->increment('views_count');

        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->where('category', $post->category)
            ->take(3)
            ->get();

        if ($relatedPosts->count() < 3) {
            $extra = Post::published()
                ->where('id', '!=', $post->id)
                ->whereNotIn('id', $relatedPosts->pluck('id'))
                ->take(3 - $relatedPosts->count())
                ->get();
            $relatedPosts = $relatedPosts->concat($extra);
        }

        return view('blog.show', compact('post', 'relatedPosts'));
    }
}
