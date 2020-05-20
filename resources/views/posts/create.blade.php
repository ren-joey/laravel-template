新增文章<br />
user_id: {{ $auth_id }}<br />
<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <select name="subject">
        @foreach ($subjects as $subject)
            <option value="{{ $subject->id }}">
                {{ $subject->title }}
            </option>
        @endforeach
    </select>
    <br />
    <label>內容：
        <textarea name="content"></textarea>
    </label>
    <!-- <br />
    @foreach ($tags as $tag)
        <input type="checkbox" name="tag" id="tag_{{ $tag->id }}" />
        <label for="tag_{{ $tag->id }}">{{ $tag->tagname }}</label>
    @endforeach -->
    <br />
    <input type="submit" value="送出文章">
</form>