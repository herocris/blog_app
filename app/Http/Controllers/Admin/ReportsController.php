<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Events\ActionWasCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('Admin')) {
            $reports = Report::all();
        } else {
            $reports = Report::where('user_id', auth()->id())->get();
            //$reports = auth()->user()->reports;
        }

        return view('admin.reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.reports.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required',
                'description' => 'required',
                'attached' => 'required|max:7000|mimes:pdf'
            ]
        );
        Report::create([
            'attached' => request()->file('attached')->store('reports', 'public'),
            'user_id' => auth()->user()->id,
            'title' => request()->get('title'),
            'description' => request()->get('description'),
        ]);
        ActionWasCreated::dispatch('informe_creado','El usuario'.auth()->user()->name.' creo el informe '.$request['title'], auth()->user()->id);
        return redirect()->route('admin.reports.index')->with('flash', 'Tu Informe ha sido Publicado exitosamente');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //$this->authorize('view', $report);
        //dd($report);
        return view('admin.reports.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //modificar la funcion update en la version de produccion
    public function update(Report $report, Request $request)
    {
        //dd($request->file);
        $datosReporte=request()->except(['_token','_method']);
        //$datosReporte['attached']=request()->file('attached')->store('reports', 'public');
        if (request()->file('attached')!=null)
        {
            //dd($request->file);
            $datosReporte['attached']=request()->file('attached')->store('reports', 'public');
            $report->attached = $datosReporte['attached'];
        }
        
        $report->title = $request->title;
        $report->description = $request->description;
        
        //dd($datosReporte->attached);
        $report->save();
        //Report::where('id', $request->id)->update($report);
        ActionWasCreated::dispatch('report_modificado', 'El usuario' . auth()->user()->name . ' modifico el reporte ' . $report->title, auth()->user()->id);
        return back()->with('flash', 'Tu informe ha sido editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        $report->delete(); //Elimina el registro del reporte en la base de datos
        Storage::disk('public')->delete($report->attached); //Elimina el reporte almacenado
        ActionWasCreated::dispatch('informe_eliminado', 'El usuario' . auth()->user()->name . ' elimino el informe ' . $report->title, auth()->user()->id);
        return redirect()->route('admin.reports.index')->with('flash', 'El reporte ha sido eliminado.');
    }
}
