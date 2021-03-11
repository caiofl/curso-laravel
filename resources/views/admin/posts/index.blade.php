<h1>Posts</h1>

@foreach ($posts as $post)
    <p>{{ $post->title }}</p>
    <P>{{ $post->content }}</P>
    <hr>
@endforeach

<a href="{{ route('posts.create') }}">Cadastrar</a>

