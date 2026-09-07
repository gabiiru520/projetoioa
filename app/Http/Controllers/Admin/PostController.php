<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $post = new Post();
        return view('admin.posts.form', compact('post'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug',
            'category' => 'required|string|max:100',
            'excerpt' => 'nullable|string|max:1000',
            'content' => 'required|string',
            'author' => 'required|string|max:100',
            'tags' => 'nullable|string|max:255',
            'status' => 'required|in:published,draft,scheduled',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|max:5120',
            'image_url' => 'nullable|url|max:500',
        ]);

        $validated['slug'] = !empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        
        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('blog', 'public');
            $validated['image'] = $path;
        } elseif (!empty($validated['image_url'])) {
            $validated['image'] = $validated['image_url'];
        }
        unset($validated['image_url']);

        Post::create($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Artigo publicado no blog com sucesso!');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.form', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug,' . $post->id,
            'category' => 'required|string|max:100',
            'excerpt' => 'nullable|string|max:1000',
            'content' => 'required|string',
            'author' => 'required|string|max:100',
            'tags' => 'nullable|string|max:255',
            'status' => 'required|in:published,draft,scheduled',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|max:5120',
            'image_url' => 'nullable|url|max:500',
        ]);

        $validated['slug'] = !empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            if ($post->image && !Str::startsWith($post->image, ['http://', 'https://'])) {
                Storage::disk('public')->delete($post->image);
            }
            $path = $request->file('image')->store('blog', 'public');
            $validated['image'] = $path;
        } elseif (!empty($validated['image_url'])) {
            $validated['image'] = $validated['image_url'];
        }
        unset($validated['image_url']);

        $post->update($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Artigo atualizado com sucesso!');
    }

    public function destroy(Post $post)
    {
        if ($post->image && !Str::startsWith($post->image, ['http://', 'https://'])) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Artigo excluído com sucesso!');
    }
}
