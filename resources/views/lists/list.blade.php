@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="mb-5">Добавить новый элемент для {{ $list->title }}</h3>

                @if ($errors->any())
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

                @if($authUserRole == 'admin')
                    <div class="mb-5">
                        <p><h6>Расшарить список</h6></p>
                        <form method="post" action="{{ route('share', ['user' => $user->id, 'list' => $list->id]) }}">@csrf
                            <div class="row">
                                <div class="col-6">
                                    <label for="formFile" class="form-label">Выбрать пользователя</label>
                                    <select name="user_id" class="form-select mb-2" aria-label="Default select example">
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="formFile" class="form-label">Роль</label>
                                    <select name="role" class="form-select mb-2" aria-label="Default select example">
                                        @foreach($roles as $role)
                                            <option value="{{ $role }}">{{ $role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="submit">Изменить права доступа</button>
                            </div>
                        </form>
                    </div>
                @endif

                @if($authUserRole == 'admin')
                    @include('list_element.create')
                @endif

                @include('list_element.elements', ['elements' => $elements])
            </div>
            <div class="col-md-2 text-center">
                <div class="mt-3 mb-3">
                    <h4>Теги списка</h4>
                    <form action="{{ route('searchByTag', ['user' => $user->id, 'list' => $list->id]) }}">
                        @foreach($uniqElementTags as $tag)
                            <div class="form-check">
                                <input name="tag[]" class="form-check-input" type="checkbox" value="{{ $tag->name }}" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $tag->name }}
                                </label>
                            </div>
                        @endforeach
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button class="btn btn-primary" type="submit">Фильтровать</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
