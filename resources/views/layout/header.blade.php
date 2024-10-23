<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Authentication</title>
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"--}}
{{--        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />--}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">Auth App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    @can('create', '\App\Models\Post')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('post.index') }}">Posts</a>
                        </li>
                    @endcan
                </ul>
                <div class="d-flex">
                    @if(auth()->check())
                        <h5 class="m-1 text-secondary">{{ auth()->user()->name }}</h5>
                        <a href="{{ route('logout') }}" class="btn btn-sm btn-danger mb-0">Logout</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-sm btn-success ms-2">Register</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>
