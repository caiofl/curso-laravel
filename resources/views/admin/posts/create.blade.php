@extends('admin.layouts.app')

@section('title', 'Criar Novo post')
    
@section('content')
<h1>Cadastrar Novo Post</h1>

<form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
    <!-- enctype="multipart/form-data" fazer upload de arquivos-->
    @include('admin.posts._partials.form')
</form>
@endsection