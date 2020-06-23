編輯文章<br />
user_id: {{ $auth_id }}<br />
<form action="{{ route('posts.update', [ 'post' => $post]) }}" method="POST">
    @method('PUT')
    @csrf
    <label>內容：
        <textarea name="content">{{ $post->content }}</textarea>
    </label><br>
    <input type="submit" value="送出文章">
</form>