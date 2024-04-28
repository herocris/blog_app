<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AjaxController extends Controller
{
    public function hola(Request $request)
    {
        $resultado = false;
        $respuesta = "10";
        $resultado = Storage::delete('/storage/temporal.pdf');
        //$respuesta = $request->hasFile('attached');
         if($request->hasFile('attached'))
         {
            $respuesta = "25";
             //$path = $request->file('attached')->store('public');
             //$request->attached->getClientOriginalName()
             $path = $request->attached->storeAs('public', 'temporal.pdf');
             
         }
        //     $respuesta = "20";
        //     $file=$request->file('attached1');
        //     $nombre = "pdf_".time().".".$file->guessExtension();
        //     $ruta = public_path("pdf/".$nombre);
        //     if($file->guessExtension()=="pdf")
        //     {
        //         copy($file, $ruta);
        //         $respuesta = "Guardado exitoso";
        //     }else
        //     {
        //         $respuesta = "No lo guardo, basura!!";
        //     }
        // }
        return response(json_encode($respuesta));
    }
    
}
