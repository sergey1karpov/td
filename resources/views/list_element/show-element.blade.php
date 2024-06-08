@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="mb-5">Back to <a href="{{ route('list.show', ['user' => $user->id, 'list' => $list->id]) }}">{{ $list->title }}</a></h3>

                <p>{{$element->description}}</p>
                @if(isset($element->images->thumbnail))
                    <img src="{{ $element->images->thumbnail }}" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                @endif
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
