@extends('layout.main')
@section('title','list movie')
@section('container')

<h1>list movie</h1>

<table class="table table-bordered">
<tr>
    <th>no</th>
    <th>title</th>
    <th>cover image</th>
    <th>year</th>
    <th>category</th>
    <th>actor</th>
    <th>aksi</th>
</tr>
@foreach ($movies as $movie)
<tr>
    <td scope ="row">{{ $loop->iteration }}</td>
    <td>{{ $movie->title }}</td>
    <td>
        @php
            $cover = $movie->cover_image;
        @endphp
        @if (Str::startsWith($cover, ['http://', 'https://']))
        <img src="{{ $cover }}" alt="{{ $movie->title }}" class="img-fluid" style="max-height: 100px">
        @else
        <img src="{{ asset('storage/' . $cover) }}" alt="Cover {{ $movie->title }}" style="max-height: 100px">
                    @endif
    </td>
    <td>{{ $movie->year }}</td>
    <td>{{ $movie->category->category_name }}</td>
    <td>{{ $movie->actor }}</td>
    <td>
        <a href="/movie/{{ $movie->id }}/{{ $movie->slug }}" class="btn btn-primary">Detail</a>
        @if (auth()->user()->role === 'admin')

        <a href="/movies/{{ $movie->id }}/edit" class="btn btn-warning">Edit</a>
        @endif
        @can('delete')

        <form action="/movies/{{ $movie->id }}" method="POST" class="d-inline">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</button>
          </form>
        @endcan
    </td>
</tr>

@endforeach

</table>

<div class="mt-4">
    {{ $movies->links('pagination::bootstrap-5') }}
  </div>
@endsection