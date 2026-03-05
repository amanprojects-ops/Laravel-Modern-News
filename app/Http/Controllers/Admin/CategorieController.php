<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::all();
        return view('admin.categories.view', compact('categories'));
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
        if (csrf_token() !== $request->input('_token')) {
            return redirect()->back()->with('error', 'Invalid request try again.');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
        ]);
        if (Categorie::where('name', $request->input('name'))->exists()) {
            return redirect()->back()->with('error', 'Category with this name already exists.');
        }
        $category = new Categorie();
        $category->name = $request->input('name');
        $category->title = $request->input('title');
        $category->save();

        return redirect()->route('admin.categories.view');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Categorie::findOrFail($id);
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Categorie::findOrFail($id);
        return view('admin.categories.update', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (csrf_token() !== $request->input('_token')) {
            return redirect()->back()->with('error', 'Invalid request try again.');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
        ]);
        $category = Categorie::findOrFail($id);
        $category->name = $request->input('name');
        $category->title = $request->input('title');
        $category->save();
        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Categorie::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.view');
    }

    /**
     * Update the status of the specified category.
     */
    public function updateStatus(Request $request, string $id)
    {
        if (csrf_token() !== $request->input('_token')) {
            return redirect()->back()->with('error', 'Invalid request try again.');
        }
        $category = Categorie::findOrFail($id);
        $category->status = $request->input('status');
        $category->save();

        return redirect()->route('admin.categories.view')->with('success', 'Status updated successfully.');
    }

    /**
     * Update the main navigation status of the specified category.
     */
    public function mainNavigation(Request $request, string $id)
    {
        if (csrf_token() !== $request->input('_token')) {
            return redirect()->back()->with('error', 'Invalid request try again.');
        }
        $category = Categorie::findOrFail($id);
        $category->main_nav = $request->input('main_nav');
        $category->save();

        return redirect()->route('admin.categories.view')->with('success', 'Main navigation updated successfully.');
    }
}
