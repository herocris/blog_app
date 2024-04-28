<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PagesController extends Controller
{
    public function home()
    {
        //Año vacio para busqueda inicial de Ajax
        $anio="";
        //Mes vacio para busqueda inicial de Ajax
        $mes="";
        //Categoria vacio para busqueda inicial de Ajax
        $cat = "";

        //Consulta que muestra todos los post menos los eventos 
        $query = Post::where([['category_id','!=',4], ['body', '!=', 'null'], ['excerpt', '!=', 'null']])->published(); 

        //Parte de la consulta que se ejecuta cuando el mes tiene un valor
        if (request('month')) {
            $mes=request('month');
            $query->whereMonth('published_at', request('month'));
        }

        //Parte de la consulta que se ejecuta cuando el año tiene un valor
        if (request('year')) {
            $anio=request('year');
            $query->whereYear('published_at', request('year'));
        }
        
        //Trae los resultados paginados por cada 10 elementos
        $posts = $query->simplePaginate(10); 
 
        return view('welcome', compact('posts','cat','mes','anio'));
    }

    public function contact()
    {
        return view('pages.contact');
        
    }

    public function indexposts(Request $request)
    {
        //Categoria vacio para busqueda inicial de Ajax
        $cat = "";
        
        $signo=request('catego')=="Evento"?'=':'!=';

        //Consulta que muestra todos los post menos los eventos
        $query = Post::where([['category_id',$signo,4], ['body', '!=', 'null'], ['excerpt', '!=', 'null']])
        ->published()
        ->with(['tags','photos','category']);//para traer registros de referentes a tablas de uno a muchos o de muchos a muchos

        //Consulta para buscar tags
        if (request('buscar')!='') {
            if (request('buscar')[0]=='#') {
                    $cadena  = request('buscar');
                    $partes = explode("#", $cadena); //Extraccion de nombre de tags de request('buscar') por medio del metodo explode de php

                $query->whereHas('tags', function ($query) use ($partes) {//subconsulta para traer registros donde el campo de la tabla relacionada de muchos a muchos se cumple
                    $query->where("name",'like', '%'.$partes[1].'%');
                });
            } 
        }
    
        //Consulta para buscar categorias que sea distinto de eventos
        if (request('catego')!="" && request('catego')!="Evento") {
            $query->whereHas('category', function ($query) {//Subconsulta para traer registros donde el campo de la tabla relacionada de muchos a muchos se cumple
                $query->where("name",'like', '%'.request('catego').'%');
             });
        } 
         
        //Consulta para buscar valor de caja de busqueda en pagina inicial
        if (request('buscar')!="" && request('buscar')[0] != '#') {
            $query->where('posts.title','like', '%'.$request->buscar.'%');
        }
        //Parte de la consulta que se ejecuta cuando el mes tiene un valor
         if (request('mes')) {
             $query->whereMonth('published_at', request('mes'));
         }
         //Parte de la consulta que se ejecuta cuando el año tiene un valor
         if (request('anio')) {
             $query->whereYear('published_at', request('anio'));
         }
         //Trae los resultados paginados por cada 10 elementos
         $posts = $query->paginate(10); 
        return response()->json(['respuesta'=>$posts, 'valortag'=> request('catego')]);
    }


    public function reports()
    {
        $reports = Report::all()->sortByDesc('created_at');
        return view('pages.reports',compact('reports'));
    }

    public function indexreports(Request $request)
    {
        //where([['category_id',$signo,4], ['body', '!=', 'null'], ['excerpt', '!=', 'null']])
        
        //Consulta de reportes
        $query = Report::where('title', '!=', 'null');

        //Consulta para buscar en la caja de busqueda en pagina de informe
        if (request('buscar')!="") {
            $query=$query->where('reports.title','like', '%'.$request->buscar.'%');
        }
        //Trae los resultados paginados por cada 5 elementos ordenados de mayor a menor
        $reports=$query->orderBy('created_at', 'DESC')->paginate(5);
        return response()->json(['respuesta'=>$reports]);
    }
}



    
