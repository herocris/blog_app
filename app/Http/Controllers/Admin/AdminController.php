<?php

namespace App\Http\Controllers\Admin;

use App\Events\ActionWasCreated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Report;

class AdminController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categorias = ["Precursores Quimicos", "Oferta", "Demanda", "Eventos", "Informes"];
        $informes = Report::all()->count();
        //dd($categoria);
        $Precursores = Post::where('category_id','=',1)->count();
        $Oferta = Post::where('category_id','=',2)->count();
        $Demanda = Post::where('category_id','=',3)->count();
        $Evento = Post::where('category_id','=',4)->count();
        $cantidades = [$Precursores,$Oferta ,$Demanda ,$Evento,$informes];
        //dd($cantidades);
        return view('admin.dashboard', compact('categorias','cantidades'));


    }
}
