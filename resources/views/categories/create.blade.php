@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{ route('displore.blog::category.store') }}">
    {{ csrf_field() }}
    <input type="text" name="name" />
    <input type="text" name="description" />
    <select name="parent">
        <option value="0">Parent category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <button type="submit">Submit</button>
</form>