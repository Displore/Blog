@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{ route('displore.blog::post.update', $post->id) }}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <input type="hidden" name="author" value="{{ $post->author_id }}" />
    <input type="text" name="title" value="{{ $post->title }}" />
    <select name="category">
        <option value="0">Category</option>
        @foreach($categories as $option)
            <?php $selected = ($option->id == $post->category_id) ? 'selected' : ''; ?>
            <option value="{{ $option->id }}" {{ $selected }}>{{ $option->name }}</option>
        @endforeach
    </select>
    <textarea name="excerpt">{{ $post->excerpt }}</textarea>
    <textarea name="content">{{ $post->content }}</textarea>
    <select name="published">
        @if($post->isPublished())
            <option value="1" selected >Published</option>
            <option value="0">Draft</option>
        @else
            <option value="1">Published</option>
            <option value="0" selected >Draft</option>
        @endif
    </select>
    <button type="submit">Submit</button>
</form>
<form method="POST" action="{{ route('displore.blog::post.delete', $post->id) }}">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button type="submit">Delete</button>
</form>