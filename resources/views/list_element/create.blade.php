<form method="post" action="{{ route('list-element.store', ['user' => $user->id, 'list' => $list->id]) }}" enctype='multipart/form-data'> @csrf
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Text</label>
        <input name="description" type="text" class="form-control" id="exampleFormControlInput1">
    </div>
    <div class="mb-3">
        <label for="formFile" class="form-label">Image</label>
        <input name="image" class="form-control" type="file" id="formFile">
    </div>
    <div class="d-grid gap-2">
        <button class="btn btn-primary" type="submit">Create element</button>
    </div>
</form>
