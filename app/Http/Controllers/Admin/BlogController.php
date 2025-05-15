<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::with(['author', 'category'])->latest()->paginate(10);
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'excerpt' => 'nullable',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $post = new Post();
        $post->title = $validated['title'];
        $post->slug = Str::slug($validated['title']);
        $post->content = $validated['content'];
        $post->excerpt = $validated['excerpt'];
        $post->category_id = $validated['category_id'];
        $post->author_id = auth()->id();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('public/blog', $filename);
            $post->image = 'storage/blog/' . $filename;
        }

        $post->save();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Article créé avec succès!');
    }

    public function edit(Post $post)
    {
        return view('admin.blog.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'excerpt' => 'nullable',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $post->title = $validated['title'];
        $post->slug = Str::slug($validated['title']);
        $post->content = $validated['content'];
        $post->excerpt = $validated['excerpt'];
        $post->category_id = $validated['category_id'];

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($post->image && Storage::exists(str_replace('storage/', 'public/', $post->image))) {
                Storage::delete(str_replace('storage/', 'public/', $post->image));
            }

            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('public/blog', $filename);
            $post->image = 'storage/blog/' . $filename;
        }

        $post->save();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Article mis à jour avec succès!');
    }

    public function destroy(Post $post)
    {
        if ($post->image && Storage::exists(str_replace('storage/', 'public/', $post->image))) {
            Storage::delete(str_replace('storage/', 'public/', $post->image));
        }

        $post->delete();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Article supprimé avec succès!');
    }
} 