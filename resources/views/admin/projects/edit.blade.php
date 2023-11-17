@extends('layouts.admin')

@section('content')
    <h1>edit project: {{ $project->name }}</h1>

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

            <form action="{{ route('admin.projects.update', $project) }}" method="post" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control"
                        @error('title') is-invalid @enderror placeholder="title" aria-describedby="helperTitle"
                        value="{{ old('title', $project->title) }}">
                    <small id="helperTitle" class="text-muted">type your project title max:50 characters</small>
                    @error('title')
                        <span class="text-danger">
                            {{ message }}
                        </span>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="type_id" class="form-label">Type</label>
                    <select class="form-select form-select" name="type_id" id="type_id">
                        <option selected disabled>Select one</option>
                        <option>untyped</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}"
                                {{ $type->id == old('type_id', $project->type_id) ? 'selected' : '' }}>
                                {{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('type_id')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>



                <label for="technologies">Select Technologies</label>
                <div class="list-group mb-3" id="technologies">

                    @foreach ($technologies as $technology)
                        <label class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" value="{{ $technology->id }}"
                                {{ $project->technologies->contains($technology->id) ? 'checked' : '' }}
                                name="technologies[]">

                            {{ $technology->name }}
                        </label>
                    @endforeach
                </div>









                <div class="mb-3">
                    <label for="git_link" class="form-label">git link</label>
                    <input type="text" name="git_link" id="git_link" class="form-control"
                        @error('git_link') is-invalid @enderror placeholder="git_link" aria-describedby="helpergit_link"
                        value="{{ old('git_link', $project->git_link) }}">
                    <small id="helpergit_link" class="text-muted">type your git project link</small>
                </div>
                @error('git_link')
                    <span class="text-danger">
                        {{ message }}
                    </span>
                @enderror

                <div class="mb-3">
                    <label for="project_link" class="form-label">external link</label>
                    <input type="text" name="project_link" id="project_link" class="form-control"
                        @error('project_link') is-invalid @enderror placeholder="project_link"
                        aria-describedby="helperproject_link" value="{{ old('project_link', $project->project_link) }}">
                    <small id="helperproject_link" class="text-muted">type your project external link</small>
                </div>
                @error('project_link')
                    <span class="text-danger">
                        {{ message }}
                    </span>
                @enderror


                <div class="mb-3 ">
                    <div>
                        <img width="200" src="{{ asset('storage/placeholders/' . $project->cover_image) }}"
                            alt="">
                    </div>
                    <label for="cover_image" class="form-label">Choose file</label>
                    <input type="file" class="form-control" @error('cover_image') is-invalid @enderror name="cover_image"
                        id="cover_image" placeholder="choose a file" aria-describedby="fileHelp">
                    <div id="fileHelp" class="form-text">add an image max 500kb</div>
                </div>
                @error('cover_image')
                    <span class="text-danger">
                        {{ message }}
                    </span>
                @enderror

                <div class="mb-3">
                    <label for="content" class="form-label">content</label>
                    <textarea class="form-control" @error('content') is-invalid @enderror name="content" id="content" rows="3">{{ old('content', $project->content) }}</textarea>
                </div>
                @error('content')
                    <span class="text-danger">
                        {{ message }}
                    </span>
                @enderror

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>

    </div>
@endsection
