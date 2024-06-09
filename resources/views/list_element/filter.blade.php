@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h5>Фильтрация по тегам:</h5>
                @foreach($inputTags as $tag)
                    <span class="badge rounded-pill text-bg-light">{{$tag}}</span>
                @endforeach
                @foreach($elements as $element)
                    <li class="list-group-item d-flex justify-content-between align-items-start mt-5">
                        <div class="ms-2 me-auto">
                            {{ $element->description }}
                            <div class="mt-3">
                                @foreach($element->tags as $tag)
                                    <span class="badge rounded-pill text-bg-light">{{$tag->name}}</span>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <div class="row">
                                <div class="mb-1 text-end">
                                    <a href="{{ route('list-element.show', ['user' => $user->id, 'list' => $list->id, 'element' => $element->id]) }}" class="btn btn-primary">Посмотреть заметку</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <hr>
                @endforeach
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
