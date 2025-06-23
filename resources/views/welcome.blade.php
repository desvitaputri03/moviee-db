@extends('layout.main')

@section('container')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <h1 class="text-center">Login</h1>
            <form action="/login" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                </div>
                <button type="submit" class="btn btn-success w-100">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection