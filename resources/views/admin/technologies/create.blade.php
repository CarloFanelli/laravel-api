@extends('layouts.admin')

@section('content')
    <h1>new technology</h1>

    @if ($errors->any())
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Alert</strong>
            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">

            <form action="{{ route('admin.technologies.store') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" aria-describedby="helpName"
                        placeholder="type name">
                    <small id="helpName" class="form-text text-muted">Enter technologies name</small>
                </div>
                @error('name')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror

                <button class="btn btn-primary" type="submit">Save</button>
            </form>

        </div>

    </div>
@endsection
