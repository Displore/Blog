@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{ route('displore.blog::tag.store') }}">
    {{ csrf_field() }}
    <input type="text" name="name" placeholder="name" />
    <input type="text" name="slug" placeholder="slug" />
    <button type="submit">Submit</button>
</form>