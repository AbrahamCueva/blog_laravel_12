<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search'); 
        $posts = Post::when($search, function ($query, $search) {
                                return $query->where('title', 'LIKE', "%{$search}%");
                            })
                            ->orderBy('id', 'desc')
                            ->paginate(10);
        return view('admin.posts.index', compact('posts', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);
        $data['user_id'] = auth()->id();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Post creado!',
            'message' => 'El post ha sido creado exitosamente.',
        ]);
        $post = Post::create($data);
        return redirect()->route('admin.posts.edit', $post)->with('success', 'Post creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:posts,slug,' . $post->id,
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'nullable',
            'content' => 'nullable',
            'is_published' => 'required|boolean',
        ]);
        $post->update($data);
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Post actualizado!',
            'message' => 'El post ha sido actualizado exitosamente.',
        ]);
        return redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
