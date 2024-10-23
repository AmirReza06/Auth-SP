@extends('layout.master')

@section('content')
    @foreach($posts as $post)
        <div class="col-12 col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->body }}</p>
                </div>
            </div>
        </div>
    @endforeach
@endsection
