@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('Dashboard') }}
        </h2>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="user_welcome">
                            {{ Auth::user()->name }} {{ __('Dashboard') }}.

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{ __('You are logged in!') }}
                        </div>
                        <div class="controls">
                            <a class="btn btn-info text-white" href="{{ route('admin.projects.create') }}">AddNew</a>
                        </div>
                    </div>
                    <div class="card-body d-flex">
                        <div class="card">
                            <div class="card-header">
                                <h6>Project counter</h6>
                            </div>
                            <div class="card-body text-center">
                                <p class="m-0">progetti:</p>
                                <h5>{{ $projects_counter }}</h5>

                                <a href="{{ route('admin.projects.index') }}"
                                    class="m-auto btn btn-secondary text-white ">progetti</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
