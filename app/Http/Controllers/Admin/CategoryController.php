<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search'); 
        $categories = Category::when($search, function ($query, $search) {
                                return $query->where('name', 'LIKE', "%{$search}%");
                            })
                            ->orderBy('id', 'desc')
                            ->paginate(10);
        return view('admin.categories.index', compact('categories', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' =>'required|string|max:255|unique:categories,name',
        ]);
        Category::create($data);
        session()->flash('swal', [
            'title' => 'Categoría creada',
            'text' => 'La categoría ha sido creada exitosamente.',
            'icon' =>'success',
        ]);
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);
        $category->update($data);
        session()->flash('swal', [
            'title' => 'Categoría actualizada',
            'text' => 'La categoría ha sido actualizada exitosamente.',
            'icon' =>'success',
        ]);
        return redirect()->route('admin.categories.index', $category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('swal', [
            'title' => 'Categoría eliminada',
            'text' => 'La categoría ha sido eliminada exitosamente.',
            'icon' =>'success',
        ]);
        return redirect()->route('admin.categories.index');
    }
}
