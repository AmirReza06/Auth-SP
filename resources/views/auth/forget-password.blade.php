@extends('layout.master')

@section('content')
    <div class="col-12 col-md-6">
        <div class="card">
            <h5 class="card-header">Forget Password</h5>
            <div class="card-body">
                @if (session()->has('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form accept="" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                        <div class="form-text text-danger">
                            @error('email')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-secondary">Accept</button>
                </form>
            </div>
        </div>
    </div>
@endsection
