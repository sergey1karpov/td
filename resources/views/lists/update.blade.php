@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="mb-5">Обновить список: {{ $list->title }}</h3>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session()->has('success'))
                    <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <form method="post" action="{{ route('list.update', ['user' => $user->id, 'list' => $list->id]) }}"> @csrf @method('PATCH')
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Заголовок</label>
                        <input name="title" type="text" class="form-control" id="exampleFormControlInput1" value="{{ $list->title }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Описание</label>
                        <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $list->description }}</textarea>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Обновить список</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
