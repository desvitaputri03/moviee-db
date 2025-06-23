@extends('layout.main')
@section('title','detail movie')
@section('container')

<h1>Detail Movie</h1>
<div class="row-lg-12">
<div class="card mb-3" style="max-width: 100%;">
    <div class="row g-0">
        <div class="col-md-4">
                    @php
                        $cover = $movie->cover_image;
                    @endphp
                    @if (Str::startsWith($cover, ['http://', 'https://']))
                        <img src="{{ $cover }}" alt="{{ $movie->title }}" class="img-fluid">
                    @else
                        <img src="{{ asset('storage/' . $cover) }}" alt="{{ $movie->title }}" class="img-fluid">
                    @endif
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{ $movie['title'] }}</h5>
                <p class="card-text">Synopsis :<br>{{$movie['synopsis'] }} {{-- Str::words($movie->$synopsis,20)  --}}
                </p>
                <p class="card-text">Actors : {{$movie['actor'] }}</p>

                <p class="card-text">Category : <a href="/category/{{ $movie->category_id }}">{{$movie->category->category_name }}</a></p>
                <p class="card-text">Year : {{$movie['year'] }}</p>
                <a href="/" class="btn btn-success">Back</a>
            </div>
        </div>
    </div>
</div>
</div>

@endsection