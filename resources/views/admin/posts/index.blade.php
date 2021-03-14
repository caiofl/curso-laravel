@extends('admin.layouts.app')

@section('title', 'listagem dos Posts')

@section('content')

<h1>Posts</h1>

<form action="{{ route('posts.search') }}" method="post">
    @csrf
    <input type="text" name="search" placeholder="Filtrar:">
    <button type="submit">Filtrar</button>
</form>


@if (session('message'))
    <div>
        {{ session('message') }}
    </div>
@endif

@foreach ($posts as $post)
    <p>
        <!--Inserindo img-->
        <img src="{{ url("storage/{$post->image}") }}" alt="{{ $post->title }}" style="max-width:100px;">
        {{ $post->title }} 
        [
            <a href="{{ route('posts.show', $post->id ) }}">Ver</a> |
            <a href="{{ route('posts.edit', $post->id ) }}">Edit</a> 
        ] 
    </p>
    <P>{{ $post->content }}</P>
    <hr>
@endforeach

<a href="{{ route('posts.create') }}">Cadastrar</a>
<hr>

<!--Paginaçao-->
@if (isset($filters))
    {{ $posts->appends($filters)->links() }}
@else
    {{ $posts->links() }}
@endif

@endsection