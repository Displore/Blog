<ul>
    @foreach($tag->posts as $post)
        <li><a href="{{ url('/blog/post/'.$post->id) }}">{{ $post->title }}</a></li>
    @endforeach
</ul>