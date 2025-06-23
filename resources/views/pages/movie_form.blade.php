@extends('layout.main')
@section('title','Form movie')
@section('navInmov','active')
@section('container')

<h1>Form Movie</h1>

<a href="/list" class="btn btn-primary mb-3">Data Movie</a>

<form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="mb-3">
        <label for="cover_image" class="form-label">Cover Image</label>
        <input type="file" class="form-control" id="cover_image" name="cover_image">
    </div>
    <div class="mb-3">
        <label for="synopsis" class="form-label">Synopsis</label>
        <textarea class="form-control" id="synopsis" name="synopsis" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="year" class="form-label">Year</label>
        <input type="number" class="form-control" id="year" name="year" required>
    </div>
    <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select class="form-select" id="category" name="category_id">
            <option value="">--pilih category--</option>
            <option value="1">Action</option>
            <option value="2">Comedy</option>
            <option value="3">Drama</option>
            <option value="4">Sci-Fi</option>
            <option value="5">Romance</option>

            {{-- @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
            @endforeach --}}

        </select>
    </div>
    <div class="mb-3">
        <label for="actor" class="form-label">Actors</label>
        <input type="text" class="form-control" id="actor" name="actor">
    </div>
    <button type="submit" class="btn btn-success mb-3">Submit</button>
</form>

@endsection