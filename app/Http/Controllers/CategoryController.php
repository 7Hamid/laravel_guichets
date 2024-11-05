<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        Category::create($request->only('name'));

        return redirect()->route('tickets.index')->with('success', 'Catégorie ajoutée avec succès.');
    }

    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }
}
