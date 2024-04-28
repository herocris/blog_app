<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Events\ActionWasCreated;

class TagsController extends Controller
{
    //

    public function index()
    {
        // if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Reader')) {
        //     $tag = Tag::all(); //obtiene todos los posts
        // } else {
        //     //$posts = Post::where('user_id',auth()->id())->get(); //obtiene unicamente los posts del usuario autenticado .
        //     $tag = auth()->user()->tag->where('visible',1); //obtiene unicamente los posts del usuario autenticado.
        // }
        $tags = Tag::where('visible' ,1)->get();
        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        // $this->authorize('create',$role=new Role);
        // $permissions = Permission::pluck('name', 'id');
        // $role = $role;
        return view('admin.tags.create');
    }

    public function store(Request $request)
    {
        //$this->authorize('create', new Tag);
        //validando el campo recibido
        //$this->validate($request, ['title' => 'required|min:20|unique:posts']);
        //crea la nueva publicacion en la BD unicamente con el titulo y id de usuario
        $tag = new Tag;
        $tag->name = $request->get('name');
        $tag->visible = 1;
        $tag->save();
        ActionWasCreated::dispatch('tag_creado', 'El usuario' . auth()->user()->name . ' creo la etiqueta ' . $tag->name, auth()->user()->id);
        //retorna la vista de edicion de publicacacion
        return redirect()->route('admin.tags.index', $tag)->with('flash', 'La Etiqueta ha sido guardada exitosamente');
    }

    public function edit(Tag $tag)
    {
        
        // $this->authorize('update', $post);
        //$this->authorize('view', $tag);
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
        //$categories = User::find(auth()->user()->id)->categories()->orderBy('name')->get();
        //dd($categories);
        //$categories = Category::find(1)->users()->orderBy('name')->get();
        //dd($usuarios);
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Tag $tag, Request $request)
    {
        //dd($request->name);
        $Datostag = new Tag;
        $Datostag=request()->except(['_token','_method']);
        $Datostag['id']=$tag->id;
        //dd($Datostag);
        Tag::where('id', $tag->id)->update($Datostag);
        ActionWasCreated::dispatch('tag_modificado', 'El usuario' . auth()->user()->name . ' modifico la Etiqueta ' . $tag->name, auth()->user()->id);
        return redirect()->route('admin.tags.index', $Datostag)->with('flash', 'La Etiqueta ha sido actualizada exitosamente');;
        //return back()->with('flash', 'La Etiqueta ha sido editado exitosamente');
        //$this->authorize('update', $tag);
    }

    // public function destroy(Tag $tag)
    // {

    //     $this->authorize('delete', $tag);
    //     $tag->update([
    //         'visible' => false
    //     ]);
    //     ActionWasCreated::dispatch('post_eliminado', 'El usuario' . auth()->user()->name . ' elimino el post ' . $post->title, auth()->user()->id);
    //     return redirect()->route('admin.posts.index')->with('flash', 'Tu publicación ha sido eliminada.');
    // }

    public function disable(Tag $tag)
    {
        //$this->authorize('delete', $tag);
        $tag->visible = false;
        $tag->update();
        ActionWasCreated::dispatch('tag_eliminado', 'El usuario' . auth()->user()->name . ' elimino la etiqueta ' . $tag->name, auth()->user()->id);
        return redirect()->route('admin.tags.index')->with('flash', 'La etiqueta ha sido eliminada.');
    }

    public function show(Tag $tag)
    {
        return view('welcome',
        [
            'title' => "Ultimas noticias de la etiqueta $tag->name",
            'posts' => $tag->posts()->simplePaginate(5)
        ]);
    }
}
