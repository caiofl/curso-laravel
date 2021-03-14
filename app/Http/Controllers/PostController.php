<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(); //Paginaçao

        return view('admin.posts.index', compact('posts'));     
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StoreUpdatePost $request)
    {
        $data = $request->all();

        if ($request->image->isValid()) {

            // Nomear Imagem para posts . extensao 
            $nameFile = Str::of($request->tilte)->slug('-'). '.' . $request->image->getClientOriginalExtension();

            //Criar imagem posts/nomedaimage
            $image = $request->image->storeAs('posts', $nameFile);
            $data['image'] = $image;
        }

        Post::create($data);

        return redirect()
            ->route('posts.index')
            ->with('message', 'Post Criado com sucesso');
    }

    public function show($id)
    {
        // Ver 
        //$post = Post::where('id', $id)->frist();
        $post = Post::find($id);

        if(!$post) {
            return redirect()->route('posts.index');
        }

        return view('admin.posts.show', compact('post'));
    }

    public function destroy($id)
    {
        if(!$post = Post::find($id)) 
            return redirect()->route('posts.index');

        if (Storage::exists($post->image))
            Storage::delete($post->image);

        //se encontrar o $post"id"
        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('message', 'Post Deletado com sucesso');
    }

    public function edit($id)
    {
        if(!$post = Post::find($id)) {
            return redirect()->back();
        }

        return view('admin.posts.edit', compact('post'));
    }

    public function update(StoreUpdatePost $request, $id) //StoreUpdatePost Validaçoes, se validar tudo cai no $request
    {
        if(!$post = Post::find($id)) {
            return redirect()->back();
        }

        $data = $request->all();

        if ($request->image && $request->image->isValid()) {
            //Deletar a imagem anterior
           if (Storage::exists($post->image))
               Storage::delete($post->image);

            // Nomear Imagem para posts . extensao 
            $nameFile = Str::of($request->tilte)->slug('-'). '.' . $request->image->getClientOriginalExtension();

            //Criar imagem posts/nomedaimage
            $image = $request->image->storeAs('posts', $nameFile);
            $data['image'] = $image;
        }


        $post->update($data);

        return redirect()
            ->route('posts.index')
            ->with('message', 'Post Atualizado com sucesso');
    }

    public function search(Request $request)
    {
        //Filtrar
        // Nao passar o token na url
        $filters = $request->except('_token');

        $posts = Post::where('title', 'LIKE', "%{$request->search}%")
                         ->orwhere('content', 'LIKE', "%{$request->search}%")
                         ->paginate();

        return view('admin.posts.index', compact('posts', 'filters'));               
    }
}
