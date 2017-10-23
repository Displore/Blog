@if (session('message'))
    <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="alert-heading">Success!</h4>
        {{ session('message') }}
    </div>
@endif

<h2>{{ $category->name }}</h2>

@if($posts->isNotEmpty())
    <ul>
        @foreach($posts as $post)
            <li><a href="{{ url('/blog/post/'.$post->id) }}">{{ $post->title }}</a></li>
        @endforeach
    </ul>
@else
    There are no posts.
@endif