<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Events\ActionWasCreated;
use Carbon\Carbon;
use App\Http\Requests\StorePostRequest;

class PostsController extends Controller
{//modificar la funcion index en la version de produccion
    public function index()
    {
        //agregar linea 20 y 33 a version de produccion 
        $id = 0;
        if (auth()->user()->hasRole('Admin')) {
            $posts = Post::all();
             //obtiene todos los posts
        }else if (auth()->user()->hasRole('Reader'))
        {
            $posts = Post::where('visible','!=','0')->get();
            //->where('category_id','!=','null');
        }
         else {
            //$posts = Post::where('user_id',auth()->id())->get(); //obtiene unicamente los posts del usuario autenticado .
            $posts = auth()->user()->posts->where('visible',1); //obtiene unicamente los posts del usuario autenticado.
        }
        return view('admin.posts.index', compact('posts','id'))->with('flash', 'Tu publicación ha sido editada exitosamente');
    }


    public function store(Request $request)
    {
        //dd("hola2");
        $this->authorize('create', new Post);
        //validando el campo recibido
        $this->validate($request, ['title' => 'required|min:20|unique:posts']);
        //crea la nueva publicacion en la BD unicamente con el titulo y id de usuario
        $post = new Post;
        $post->title = $request->get('title');
        $post->published_at = Carbon::now();
        $post->user_id = auth()->user()->id;
        //$post->category_id = 1;
        $post->save();
        ActionWasCreated::dispatch('post_creado', 'El usuario' . auth()->user()->name . ' creo el post ' . $post->title, auth()->user()->id);
        //retorna la vista de edicion de publicacacion
        return redirect()->route('admin.posts.edit', $post);
    }

    public function edit(Post $post)
    {
       
        // $this->authorize('update', $post);
        $this->authorize('view', $post);
        //$categories = Category::all();
        //dd(auth()->user()->id);
        //$categori = Category::where('id',1)->first();
        //$categori->users;
        //$jkd=$categori->users;
        //$categories = Category::all();

        //$usuario = User::find(auth()->user()->id);
        //dd($usuario);
        //$jkd=$usuario->categories;
        //dd($jkd);
        $categories = User::find(auth()->user()->id)->categories()->orderBy('name')->get();
        //dd($categories);
        //$categories = Category::find(1)->users()->orderBy('name')->get();
        //dd($usuarios);
        $tags = Tag::all();
        return view('admin.posts.edit', compact('categories', 'tags', 'post'));
    }

    public function update(Post $post, StorePostRequest $request)
    {
        //dd("Hola");
        $this->authorize('update', $post);
        $post->update($request->all());
        $post->tags()->sync($request->get('tags'));
        ActionWasCreated::dispatch('post_modificado', 'El usuario' . auth()->user()->name . ' modifico el post ' . $post->title, auth()->user()->id);
        return redirect()->route('admin.posts.index')->with('flash', 'Tu publicación ha sido guardada exitosamente');
    }

    public function destroy(Post $post)
    {

        $this->authorize('delete', $post);
        $post->update([
            'visible' => false
        ]);
        ActionWasCreated::dispatch('post_eliminado', 'El usuario' . auth()->user()->name . ' elimino el post ' . $post->title, auth()->user()->id);
        return redirect()->route('admin.posts.index')->with('flash', 'Tu publicación ha sido eliminada.');
    }

    public function disable(Post $post)
    {
        $this->authorize('delete', $post);
        $post->visible = false;
        $post->update();
        ActionWasCreated::dispatch('post_eliminado', 'El usuario' . auth()->user()->name . ' elimino el post ' . $post->title, auth()->user()->id);
        return redirect()->route('admin.posts.index')->with('flash', 'Tu publicación ha sido eliminada.');
    }

    //agregar esta funcion a la version de produccion 
    public function modal($id)
    {
        //dump($id);
        if (auth()->user()->hasRole('Admin')) {
            $posts = Post::all();
             //obtiene todos los posts
        }else if (auth()->user()->hasRole('Reader'))
        {
            $posts = Post::where('visible','!=','0')->get();
            //->where('category_id','!=','null');
        }
         else {
            //$posts = Post::where('user_id',auth()->id())->get(); //obtiene unicamente los posts del usuario autenticado .
            $posts = auth()->user()->posts->where('visible',1); //obtiene unicamente los posts del usuario autenticado.
        }
        return view('admin.posts.index', compact('posts', 'id'))->with('flash', 'Tu publicación ha sido editada exitosamente');

    }
}
