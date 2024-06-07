@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="m">Hello, {{ $user->name ?? $user->email}}!</h3>
                <h5 class="mb-5">This is all your lists</h5>

                <div>
                    <ol class="list-group list-group-numbered">
                        @foreach($lists as $list)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <p><strong>{{ $list->title }}</strong></p>
                                    {{ $list->description }}
                                </div>
                                <div class="btn-group mr-5">
                                    <button type="button" class="btn btn-info">Add List element</button>
                                    <a href="{{ route('list.edit', ['user' => $user->id, 'list' => $list->id]) }}" class="btn btn-primary">Edit</a>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
