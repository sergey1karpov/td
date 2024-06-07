@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="m">Hello, {{ $user->name ?? $user->email}}!</h3>
                <h5 class="mb-5">This is all your lists</h5>

                @if(session()->has('success'))
                    <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div>
                    <ol class="list-group list-group-numbered">
                        @foreach($lists as $list)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <p><strong>{{ $list->title }}</strong></p>
                                    {{ $list->description }}
                                </div>
                                <div>
                                    <div class="mb-1 text-end">
                                        <a href="{{ route('list.edit', ['user' => $user->id, 'list' => $list->id]) }}" class="btn btn-success">Show List items</a>
                                    </div>
                                    <div class="mb-1 text-end">
                                        <button type="button" class="btn btn-info">Add List element</button>
                                    </div>
                                    <div class="mb-1 text-end">
                                        <a href="{{ route('list.edit', ['user' => $user->id, 'list' => $list->id]) }}" class="btn btn-primary">Edit</a>
                                    </div>
                                    <div class="text-end">
                                        <form method="post" action="{{ route('list.delete', ['user' => $user->id, 'list' => $list->id]) }}">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
