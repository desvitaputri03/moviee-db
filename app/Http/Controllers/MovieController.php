<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function homepage()
    {
        $movies = Movie::latest()->paginate(2); // hanya 2 per halaman
        return view('homepage', compact('movies'));
    }

    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return view('detail', compact('movie'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('create_movie', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'year' => 'required|integer',
            'actors' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $slug = Str::slug($request->title);
        $coverPath = null;

        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('covers', 'public');
        }

        Movie::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'synopsis' => $validated['synopsis'],
            'category_id' => $validated['category_id'],
            'year' => $validated['year'],
            'actors' => $validated['actors'],
            'cover_image' => $coverPath,
        ]);

        return redirect('/')->with('success', 'Data Movie Berhasil Disimpan.');
    }

    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $categories = Category::all();
        return view('edit_movie', compact('movie', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'year' => 'required|integer',
            'actors' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $slug = Str::slug($request->title);
        $movie->slug = $slug;

        if ($request->hasFile('cover_image')) {
            if ($movie->cover_image) {
                Storage::disk('public')->delete($movie->cover_image);
            }

            $coverPath = $request->file('cover_image')->store('covers', 'public');
            $movie->cover_image = $coverPath;
        }

        $movie->update([
            'title' => $validated['title'],
            'synopsis' => $validated['synopsis'],
            'category_id' => $validated['category_id'],
            'year' => $validated['year'],
            'actors' => $validated['actors'],
            'slug' => $slug,
            'cover_image' => $movie->cover_image,
        ]);

        return redirect('/')->with('success', 'Data Movie Berhasil Diupdate.');
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);

        if ($movie->cover_image) {
            Storage::disk('public')->delete($movie->cover_image);
        }

        $movie->delete();

        return redirect('/')->with('success', 'Data Movie Berhasil Dihapus.');
    }
}
