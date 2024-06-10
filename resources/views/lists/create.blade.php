@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="mb-5">Создать новый список</h3>

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

                <div id="info" class="alert alert-success text-center alert-dismissible fade show" role="alert" style="display: none">
                    <strong>Список добавлен</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="post" action="{{ route('list.store', ['user' => $user->id]) }}"> @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Заголовок</label>
                        <input name="title" id="title" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Описание</label>
                        <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" id="addList" type="button">Создать список</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
<script type="module">
    $("#addList").click(function(e) {
        e.preventDefault();

        const title = $("#title").val();
        const description = $("#description").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ route('list.store', ['user' => $user->id]) }}",
            type: "POST",
            data: {
                title: title,
                description: description,
            },
            success: function(data) {
                $("#info").show();
                $("#title").val("");
                $("#description").val("");
            },
            error: function() {
                alert('errorroror');
            },

        });

    });
</script>
