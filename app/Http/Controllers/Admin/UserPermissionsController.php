<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Events\ActionWasCreated;

class UserPermissionsController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->syncPermissions($request->permissions);
        ActionWasCreated::dispatch('userPermission_modificado', 'El usuario' . auth()->user()->name . ' modifico los permisos del usuario ' . $user->name, auth()->user()->id);
        return back()->withFlash('Los Permisos se actualizaron satisfactoriamente.');
    }


}
