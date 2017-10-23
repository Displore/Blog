This is the frontpage.

    <ul>
        @foreach($categories as $category)
            <li>
                <a href="{{ route('displore.blog::category.show', ['id' => $category->id]) }}">
                    {{ $category->name }}
                </a>
            </li>
        @endforeach
    </ul>

