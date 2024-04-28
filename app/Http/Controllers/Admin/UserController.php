<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
//use App\Http\Controllers\Category;
use App\Models\Category;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Events\ActionWasCreated;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::allowed()->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        $this->authorize('create', $user);
        $roles = Role::with('permissions')->get();
        $categories = Category::all();
        //dd($category);
        $permissions = Permission::pluck('name', 'id');
        return view('admin.users.create', compact('user', 'roles','categories', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $this->authorize('create', new User);

        $data = $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8'
        ]);
        $user = User::create($data);
        $usuarioUltimo = User::latest('id')->first();/**Trae el ultimo usuario creado */
        $user->assignRole($request->roles);
        $user->givePermissionTo($request->permissions);
        $categorias=$request->categories;/** asigna las categorias a una nueva variable */
        foreach ($categorias as $category){ /**recorre las categorias para guardar  */
            $usuarioUltimo->categories()->attach($category);/**guardar en la tabla intermedia */
            }
            ActionWasCreated::dispatch('usuario_creado', 'El usuario' . auth()->user()->name . ' creo el usuario ' . $user->name, auth()->user()->id);
        return redirect()->route('admin.users.index')->with('flash', 'Usuario creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        $this->authorize('update', $user);

        //$roles=Role::all();
        // $roles=Role::pluck('name','id');
        $roles = Role::with('permissions')->get();
        $categories = Category::all();
        //Category::find($user->id);
        //dd($categories);
        $permissions = Permission::pluck('name', 'id');
        return view('admin.users.edit', compact('user', 'roles', 'categories', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //dd($request);
        $this->authorize('update', $user);

        $data = $request->validated();
        $user->update($data);
        ActionWasCreated::dispatch('usuario_modificado', 'El usuario' . auth()->user()->name . ' modifico el usuario ' . $user->name, auth()->user()->id);
        return redirect()->route('admin.users.show', $user)->with('flash', 'Informacion de usuario actualizada satisfactoriamente.');
    }

    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete',$user);
        $user->visible = false;
        $user->update();
        ActionWasCreated::dispatch('usuario_eliminado', 'El usuario' . auth()->user()->name . ' elimino el usuario ' . $user->name, auth()->user()->id);
        return redirect()->route('admin.users.index')->withFlash('Usuario Eliminado');
    }


    public function disable(User $user)
    {
        $this->authorize('delete',$user);
        $user->visible = false;
        $user->password = bcrypt($user->password);
        $user->update();
        ActionWasCreated::dispatch('usuario_eliminado', 'El usuario' . auth()->user()->name . ' elimino el usuario ' . $user->name, auth()->user()->id);
        return redirect()->route('admin.users.index')->withFlash('Usuario Eliminado');
    }
}
