文章內容
<hr />
    {{ $post->content }}
<hr />
@foreach($post->tags as $tag)
    <span>{{ $tag->tagname }}</span>
@endforeach
<!-- <button>編輯文章</button> <button>刪除文章</button> -->