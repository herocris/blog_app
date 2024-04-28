<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Binnacles;
use Illuminate\Http\Request;

class BinnacleController extends Controller
{
    public function index()
    {
        $registros=Binnacles::all();
        return view('admin.binnacles.index',compact('registros'));
    }
}
