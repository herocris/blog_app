<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Requests\SaveRolesRequest;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view',new Role);
        return view('admin.roles.index', [
            'roles' => Role::all()

        ]);
        //Retorna la vista en /resources/views/admin/roles/index.blade.php/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function create()
    {
        $this->authorize('create',$role=new Role);
        $permissions = Permission::pluck('name', 'id');
        $role = $role;
        return view('admin.roles.create', compact('permissions', 'role'));
    }

    /**
     * Store a newly created resource in storage.*/

    //@param  \Illuminate\Http\Request  $request
    // @return \Illuminate\Http\Response

    public function store(SaveRolesRequest $request)
    {
        $this->authorize('store',new Role);
        //Las validaciones se estan realizando mediante la clase SaveRolesRequest
        $role = Role::create($request->validated());
        if ($request->has('permissions')) {
            $role->givePermissionTo($request->permissions);
        }
        return redirect()->route('admin.roles.index')->withFlash('Rol creado con exito !!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::pluck('name', 'id');
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveRolesRequest $request, Role $role)
    {
        //dd($request);
        $this->authorize('update', $role); //se validan los permisos
        //Las validaciones se estan realizando mediante la clase SaveRolesRequest
        $role->update($request->validated());
        $role->permissions()->detach();

        if ($request->has('permissions')) {
            $role->givePermissionTo($request->permissions);
        }

        return redirect()->route('admin.roles.edit', $role)->withFlash('Rol actualizado con exito !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {

        $this->authorize('delete', $role);
        $role->delete();
        return redirect()->route('admin.roles.index', $role)->withFlash('Rol Eliminado con exito !!');
    }
}
