<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
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
            'image' => 'nullable|image',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'is_published' => 'required|boolean',
        ]);
        
        if ($request->hasFile('image')) {
            if ($post->image_path && file_exists(public_path($post->image_path))) {
                unlink(public_path($post->image_path));
            }
            
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/posts'), $fileName);
            $data['image_path'] = 'uploads/posts/' . $fileName;
        }
        $post->update($data);
        $post->tags()->sync($data['tags'] ?? []);
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
        if ($post->image_path && file_exists(public_path($post->image_path))) {
            unlink(public_path($post->image_path));
        }
        $post->delete();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Post eliminado!',
            'message' => 'El post ha sido eliminado exitosamente.',
        ]);

        return redirect()->route('admin.posts.index');
    }
}
