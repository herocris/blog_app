<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;

class CategoriesController extends Controller
{   
    // $hola=12;
    // dd($hola);
    public function show(Category $category)
    {
        $anio="";
        $mes="";
        $posts = $category->posts()->where([['body', '!=', 'null'], ['excerpt', '!=', 'null'], ['visible', '!=', '0']])->orderBy('published_at', 'DESC')->simplePaginate(5);
        if(!$posts->isEmpty()){
            $title = "Últimas noticias de la categoría ".$category->name;
            $cat=$category->name;
        }else{
            $title = "Upps , No hay publicaciones para la categoría ".$category->name;
            $cat=$category->name;
        }
        //dd($cat);
        return view('welcome',compact('title','posts','cat','mes','anio'));
    }

    // public function updateCategoria(UpdateUserRequest $request, User $user)
    // {
    //     dd($request);
    //     $categorias=$request->categories;/** asigna las categorias a una nueva variable */
    //     foreach ($categorias as $category){ /**recorre las categorias para guardar  */
    //         $user->categories()->attach($category);/**guardar en la tabla intermedia */
    //         }
    // }
    

    /* public function evento(Category $category)
    {
        $query = Post::where('category_id','=',4);
        return view('welcome',compact('query'));
    } */
}
