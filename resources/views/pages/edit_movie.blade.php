
@extends('layout.main')
@section('title','Edit movie')
@section('container')

<h1>Edit Movie</h1>

<form action="/movies/{{ $movies->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $movies->title) }}" required>
    </div>
    <div class="mb-3">
        <label for="cover_image" class="form-label">Cover Image</label>
        <input type="file" class="form-control" id="cover_image" name="cover_image" value="{{ old('cover_image', $movies->cover_image) }}">
    </div>
    <div class="mb-3">
        <label for="synopsis" class="form-label">Synopsis</label>
        <textarea class="form-control" id="synopsis" name="synopsis" rows="5" required>{{ old('synopsis', $movies->synopsis) }}</textarea>
    </div>
    <div class="mb-3">
        <label for="year" class="form-label">Year</label>
        <input type="number" class="form-control" id="year" name="year" value="{{ old('year', $movies->year) }}" required>
    </div>
    <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select class="form-select" id="category" name="category_id">
            <option value="">--pilih category--</option>
            <option value="1" {{ old('categoty_id', $movies->category_id) == 1 ? 'selected' : '' }}>Action</option>
            <option value="2" {{ old('categoty_id', $movies->category_id) == 2 ? 'selected' : '' }}>Comedy</option>
            <option value="3" {{ old('categoty_id', $movies->category_id) == 3 ? 'selected' : '' }}>Drama</option>
            <option value="4" {{ old('categoty_id', $movies->category_id) == 4 ? 'selected' : '' }}>Sci-Fi</option>
            <option value="5" {{ old('categoty_id', $movies->category_id) == 5 ? 'selected' : '' }}>Romance</option>

            {{-- @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
            @endforeach --}}

        </select>
    </div>
    <div class="mb-3">
        <label for="actor" class="form-label">Actors</label>
        <input type="text" class="form-control" id="actor" name="actor" value="{{ old('actor', $movies->actor) }}">
    </div>
    <button type="submit" class="btn btn-success mb-3">Submit</button>
</form>

@endsection