<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{

    public function index()
    {
        $this->authorize('view',new Permission());
        return view('admin.permissions.index', [
            'permissions' => Permission::all()

        ]);
        //Retorna la vista en /resources/views/admin/roles/index.blade.php/
    }


    public function create()
    {
        $this->authorize('create',$permission=new Permission());
        return view('admin.permissions.create');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:permissions',
            'display_name' => 'required'
        ]);
        $permission = permission::create($data);
        return redirect()->route('admin.permissions.index')->withFlash('Permiso creado con exito !!');
    }



    public function edit(Permission $permission)
    {
        // $this->authorize('edit',$permission=new Permission());
        $permissions = Permission::pluck('name', 'id');
        return view('admin.permissions.edit', compact('permission', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $this->authorize('update',$permission());
        $data = $request->validate(
            ['display_name' => 'required']
        );
        $permission->update($data);
        return redirect()->route('admin.permissions.edit', $permission)->withFlash('Permiso actualizado con exito !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
