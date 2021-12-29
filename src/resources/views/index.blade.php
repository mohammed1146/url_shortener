@extends('layout.master')

@section('title', 'Url Shorter Home Page')

@section('content')
    <h3 class="pt-5 pb-5">Welcome to Url Shortener</h3>

    <form method="post" action="/url-shortener">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">URL</label>
            <input type="url" name="url" placeholder="URL to shorten" class="form-control" autofocus required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    @isset($code)
        <hr>
        <span>{{ config('app.url') }}/{{ $code }}</span>
    @endif

@endsection
