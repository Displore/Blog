@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{ route('displore.blog::post.store') }}">
    {{ csrf_field() }}
    <input type="hidden" name="author" value="1" />
    <input type="text" name="title" placeholder="Title" />
    <select name="category">
        <option value="0">Category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <textarea name="excerpt" placeholder="Excerpt"></textarea>
    <textarea name="content" placeholder="Content"></textarea>
    <select name="published">
        <option value="1">Published</option>
        <option value="0">Draft</option>
    </select>
    <button type="submit">Submit</button>
</form>