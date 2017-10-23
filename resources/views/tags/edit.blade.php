@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{ route('displore.blog::tag.update', $tag->id) }}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <input type="text" name="name" value="{{ $tag->name }}" />
    <input type="text" name="slug" value="{{ $tag->slug }}" />
    <button type="submit">Submit</button>
</form>
<form method="POST" action="{{ route('displore.blog::tag.delete', $tag->id) }}">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button type="submit">Delete</button>
</form>