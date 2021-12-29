@extends('layout.master')

@section('title', 'Url Shorter List')

@section('content')
    <h3 class="pt-5 pb-5">Url Shortener List</h3>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Short Url</th>
            <th scope="col">Original Url</th>
            <th scope="col">Creation Date</th>
        </tr>
        </thead>
        <tbody>
            @foreach($urls as $url)
                <tr>
                    <th scope="row">{{ $url->id }}</th>
                    <td>{{ config('app.url') }}/{{ $url->key }}</td>
                    <td><a href="{{ $url->original_url }}" target="_blank">click here</a></td>
                    <td>{{ $url->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
