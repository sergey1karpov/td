@foreach($elements as $element)
    <li class="list-group-item d-flex justify-content-between align-items-start mt-5">
        <div class="ms-2 me-auto">
            {{ $element->description }}
            <div class="mt-3">
                @foreach($element->tags as $tag)
                <span class="btn badge text-bg-primary">{{$tag->name}}</span>
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
