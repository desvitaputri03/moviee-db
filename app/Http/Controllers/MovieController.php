<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MovieController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $movies = Movie::query()
        ->when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        })
        ->latest()
        ->paginate(6);

    return view('pages.home', compact('movies', 'search'));
}

    public function detailMovie($id, $slug){
        $movie = Movie::find($id);
        return view('pages.detail_movie', compact('movie'));
    }

    public function create(){
        $categories = Category::all();
        return view('pages.movie_form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'synopsis' => 'required|string',
            'year' => 'required|integer|min:1800|max:' . date('Y'),
            'category_id' => 'required|exists:categories,id',
            'actor' => 'nullable|string|max:255',
        ]);

        // Simpan file gambar
        $imagePath = $request->file('cover_image')->store('cover_images', 'public');

        // Simpan data ke database
        Movie::create([
            'title' => $validated['title'],
            'cover_image' => $imagePath,
            'slug' => Str::slug($validated['title']),
            'synopsis' => $validated['synopsis'],
            'year' => $validated['year'],
            'category_id' => $validated['category_id'],
            'actor' => $validated['actor'],
        ]);

        return redirect('/')->with('success', 'Movie has been added!');
    }

    public function list()
    {
        $movies = Movie::paginate(10);
        return view('pages.list_movie', compact('movies'));
    }

    public function edit($id)
    {
        $movies = Movie::findorfail($id);
        return view('pages.edit_movie', compact('movies'));
    }

    public function update(Request $request, $id)
    {

        $movies = Movie::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'synopsis' => 'required|string',
            'year' => 'required|integer|min:1800|max:' . date('Y'),
            'category_id' => 'required|exists:categories,id',
            'actor' => 'nullable|string|max:255',
        ]);

        if ($request->file('cover_image')) {
            $imagePath = $request->file('cover_image')->store('cover_images', 'public');
            $movies->cover_image = $imagePath;
        }

        $movies->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'synopsis' => $validated['synopsis'],
            'year' => $validated['year'],
            'category_id' => $validated['category_id'],
            'actor' => $validated['actor'],
        ]);
        return redirect('/list')->with('success', 'berhasil mengupdate data movie');
    }

    public function destroy($id)
    {
        if(Gate::allows('delete')){

            $data = Movie::findorfail($id);
            $data->delete();
            return redirect()->back()->with('success', 'data berhasil di hapus');
        }

    }
}