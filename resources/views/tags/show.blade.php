<h2>{{ $post->title }}</h2>
<p>
    {{ $post->content }}
</p>
<p>
<small>
    Written by {{ $post->author->name }} on {{ $post->created_at }}
</small>
</p>