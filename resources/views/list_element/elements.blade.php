@foreach($elements as $element)
    <li class="list-group-item d-flex justify-content-between align-items-start mt-5">
        <div class="ms-2 me-auto">
            {{ $element->description }}
        </div>
        <div>
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
    <hr>
@endforeach
