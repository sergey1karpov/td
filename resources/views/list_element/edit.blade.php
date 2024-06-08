@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
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

                <h3 class="mb-5">Редактировать <a href="{{ route('list-element.show', ['user' => $user->id, 'list' => $list->id, 'element' => $element->id]) }}">{{ $element->description }}</a></h3>

                @if(isset($element->images->thumbnail))
                    <h5 class="mb-1">Текущее изображение заметки "{{ $element->description }}"</h5>
                    <img src="{{ $element->images->thumbnail }}" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="mb-1">
                    <form method="post" action="{{ route('list-element.delete-image', ['user' => $user->id, 'list' => $list->id, 'element' => $element->id]) }}">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger mb-5">Удалить изображение</button>
                    </form>
                @endif

                <form method="post" action="{{ route('list-element.update', ['user' => $user->id, 'list' => $list->id, 'element' => $element->id]) }}" enctype='multipart/form-data'>
                    @csrf @method('PATCH')
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Text</label>
                        <input name="description" type="text" class="form-control" id="exampleFormControlInput1" value="{{ $element->description }}">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Image</label>
                        <input name="image" class="form-control" type="file" id="formFile">
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary mb-1" type="submit">Изменить заметку</button>
                    </div>
                </form>
                    <div class="d-grid gap-2">
                        <form action="{{ route('list-element.delete', ['user' => $user->id, 'list' => $list->id, 'element' => $element->id]) }}" method="post">
                            @csrf @method('DELETE')
                            <div class="d-grid gap-2">
                                <button class="btn btn-danger" type="submit">Удалить заметку</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: max-content !important">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if(isset($element->images->image))
                        <img src="{{ $element->images->image }}">
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
