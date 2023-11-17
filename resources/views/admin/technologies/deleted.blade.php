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

                            {{ __('Trashed Projects') }}
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                class="table table-striped
                            table-hover	
                            table-borderless
                            table-dark
                            align-middle">
                                <thead class="table-light">
                                    <caption>All Deleted Projects</caption>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">TITLE</th>
                                        <th class="text-center">SLUG</th>
                                        <th class="text-center">IMG</th>
                                        <th class="text-center">LINK</th>
                                        <th class="text-center">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @forelse ($trashed as $trash)
                                        <tr class="table-primary">
                                            <td class="text-center m-auto" scope="row">{{ $trash->id }}</td>
                                            <td class="text-center m-auto">{{ $trash->title }}</td>
                                            <td class="text-center m-auto">{{ $trash->slug }}</td>
                                            <td class="text-center m-auto">
                                                @if ($trash->cover_image)
                                                    <img class="img-fluid w-25"
                                                        src="{{ asset('storage/placeholders/' . $trash->cover_image) }}"
                                                        alt="">
                                                @endif
                                            </td>
                                            <td class="text-center m-auto"><a
                                                    href="{{ $trash->external_link }}">{{ $trash->external_link }}</a>
                                            </td>

                                            <td class="text-center m-auto">

                                                <a class="btn btn-success"
                                                    href="{{ route('admin.projects.show', $trash) }}">
                                                    <i class="fa-solid fa-eye text-white"></i>
                                                </a>

                                                <form action="{{ route('admin.restore', $trash->slug) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-warning" type="submit">
                                                        <i class="fa-solid fa-trash-can-arrow-up text-white"></i>
                                                    </button>
                                                </form>

                                                <!-- Modal trigger button -->
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#modalId-{{ $trash->id }}">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>

                                                <!-- Modal Body -->
                                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                                <div class="modal fade" id="modalId-{{ $trash->id }}" tabindex="-1"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                                    aria-labelledby="modalTitleId" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalTitleId">Delete</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                are you sure you want to delete {{ $trash->title }}?
                                                            </div>
                                                            <div class="modal-footer justify-content-evenly">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <form
                                                                    action="{{ route('admin.forceDelete', $trash->slug) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger">delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Optional: Place to the bottom of scripts -->
                                                <script>
                                                    const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
                                                </script>

                                            </td>
                                        </tr>
                                    @empty
                                        <h1>no deleted projects here!</h1>
                                    @endforelse



                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{ $trashed->links('pagination::bootstrap-5') }}

    </div>
@endsection
