列舉所有文章<br />
<hr />
@foreach($posts as $post)
    {{ $post->content }}
    <hr />
@endforeach