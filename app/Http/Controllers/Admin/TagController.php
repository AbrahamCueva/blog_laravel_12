<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search'); 
        $tags = Tag::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%");
        })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.tags.index', compact('tags', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' =>'required|string|max:255|unique:tags,name',
        ]);
        Tag::create($data);
        session()->flash('swal', [
            'title' => 'Etiqueta creada',
            'text' => 'La etiqueta ha sido creada exitosamente.',
            'icon' =>'success',
        ]);
        return redirect()->route('admin.tags.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $tag->id,
        ]);
        $tag->update($data);
        session()->flash('swal', [
            'title' => 'Etiqueta actualizada',
            'text' => 'La etiqueta ha sido actualizada exitosamente.',
            'icon' =>'success',
        ]);
        return redirect()->route('admin.tags.index', $tag);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        session()->flash('swal', [
            'title' => 'Etiqueta eliminada',
            'text' => 'La etiqueta ha sido eliminada exitosamente.',
            'icon' =>'success',
        ]);
        return redirect()->route('admin.tags.index');
    }
}
