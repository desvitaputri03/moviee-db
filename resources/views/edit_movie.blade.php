@extends('layouts.template')

@section('content')
<h1>Edit Movie</h1>

<form action="{{ url('/update-movie/' . $movie->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- Title --}}
    <div class="mb-3 row">
        <label for="title" class="col-sm-2 col-form-label">Title</label>
        <div class="col-sm-10">
            <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $movie->title) }}" required>
        </div>
    </div>

    {{-- Synopsis --}}
    <div class="mb-3 row">
        <label for="synopsis" class="col-sm-2 col-form-label">Synopsis</label>
        <div class="col-sm-10">
            <textarea name="synopsis" class="form-control" id="synopsis" rows="3" required>{{ old('synopsis', $movie->synopsis) }}</textarea>
        </div>
    </div>

    {{-- Category --}}
    <div class="mb-3 row">
        <label for="category_id" class="col-sm-2 col-form-label">Category</label>
        <div class="col-sm-10">
            <select name="category_id" id="category_id" class="form-select" required>
                <option disabled>-- Select Category --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $movie->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Year --}}
    <div class="mb-3 row">
        <label for="year" class="col-sm-2 col-form-label">Year</label>
        <div class="col-sm-10">
            <input type="number" name="year" class="form-control" id="year" value="{{ old('year', $movie->year) }}" required>
        </div>
    </div>

    {{-- Actors --}}
    <div class="mb-3 row">
        <label for="actors" class="col-sm-2 col-form-label">Actors</label>
        <div class="col-sm-10">
            <input type="text" name="actors" class="form-control" id="actors" value="{{ old('actors', $movie->actors) }}" required>
        </div>
    </div>

    {{-- Current Cover --}}
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Current Cover</label>
        <div class="col-sm-10">
            <img src="{{ asset('storage/' . $movie->cover_image) }}" width="150" alt="Cover Image" class="img-thumbnail mb-2">
        </div>
    </div>

    {{-- New Cover Upload --}}
    <div class="mb-3 row">
        <label for="cover_image" class="col-sm-2 col-form-label">Change Cover</label>
        <div class="col-sm-10">
            <input type="file" name="cover_image" class="form-control" id="cover_image">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti cover.</small>
        </div>
    </div>

    <div class="mb-3 row">
        <div class="col-sm-10 offset-sm-2">
            <button type="submit" class="btn btn-primary">Update Movie</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
</form>
@endsection