@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{ route('displore.blog::category.update', $category->id) }}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <input type="text" name="name" value="{{ $category->name }}" />
    <input type="text" name="description" value="{{ $category->description }}" />
    <select name="parent">
        <option value="0">Parent category</option>
        @foreach($categories as $option)
            <?php $selected = ($loop->index == $category->id) ? 'selected' : ''; ?>
            <option value="{{ $option->id }}" {{ $selected }}>{{ $option->name }}</option>
        @endforeach
    </select>
    <button type="submit">Submit</button>
</form>
<form method="POST" action="{{ route('displore.blog::category.delete', $category->id) }}">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button type="submit">Delete</button>
</form>