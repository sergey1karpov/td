@foreach($elements as $element)
    <li class="list-group-item d-flex justify-content-between align-items-start mt-5">
        <div class="ms-2 me-auto">
            {{ $element->description }}
        </div>
        <div>
            <div class="row">
                <div class="col-4">
                    <div class="mb-1 text-end">
                        <a href="{{ route('list-element.show', ['user' => $user->id, 'list' => $list->id, 'element' => $element->id]) }}" class="btn btn-primary">Watch</a>
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-1 text-end">
                        <a href="{{ route('list.edit', ['user' => $user->id, 'list' => $list->id]) }}" class="btn btn-primary">Edit</a>
                    </div>
                </div>
                <div class="col-4">
                    <div class="text-end">
                        <form method="post" action="{{ route('list.delete', ['user' => $user->id, 'list' => $list->id]) }}">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </li>
    <hr>
@endforeach
