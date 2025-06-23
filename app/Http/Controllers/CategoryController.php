<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $movies = Movie::paginate(10);
        // return view('pages.home', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        $movies= Movie::where('category_id', $id)->paginate(6);

        return view('pages.show', compact('category','movies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $categories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $categories)
    {
        //
    }
}