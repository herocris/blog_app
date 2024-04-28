<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Events\ActionWasCreated;

class UserCategoriesController extends Controller
{
    //

    public function update(Request $request, User $user)
    {
        $categorias= $request->categories;
        $user->categories()->detach();// metodo para borrado de registros existentes en tabla intermedia.
        foreach ($categorias as $value) {// insercion de las categorias nuevas en la tabla intermedia.
            $user->categories()->attach($value);
        }
        ActionWasCreated::dispatch('userCategory_modificado', 'El usuario' . auth()->user()->name . ' modifico la categoria del usuario ' . $user->name, auth()->user()->id);
        return back()->withFlash('Las Categorias se actualizaron satisfactoriamente.');
    }
}
