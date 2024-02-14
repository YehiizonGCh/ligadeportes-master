<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-usuario|crear-usuario|editar-usuario|borrar-usuario')->only('index');
        $this->middleware('permission:crear-usuario', ['only' => ['store']]);
        $this->middleware('permission:editar-usuario', ['only' => ['update']]);
        $this->middleware('permission:borrar-usuario', ['only' => ['destroy']]);
    }
    
    public function index(Request $request)
    {
        $texto= trim($request->get('texto'));
        $roles = Role::pluck('name', 'name')->all();
        $usuarios = User::where('name','LIKE','%'.$texto.'%')
            ->orderBy('id','asc')
            ->paginate(6);
        return view('usuarios.index', compact('usuarios', 'roles', 'texto'));

    }

    
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('usuarios.crear', compact('roles'));
    }

    
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('usuarios.index')->with('create', 'Registro agregado correctamente');
    }

   
    public function show($id)
    {
        $user = User::find($id);
        return view('usuarios.mostrar', compact('user'));
    }

    
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('usuarios.editar', compact('user', 'roles', 'userRole'));
    }


    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('usuarios.index')->with('update', 'Registro actualizado correctamente');
    }

    
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('usuarios.index')->with('delete', 'Registro eliminado correctamente');
    }
    public function cambiarEstado($id)
    {
        $usuario = User::find($id);
        if ($usuario->estado == 1) {
            DB::table('users')->where('id', $id)->update(['estado' => 0]);
            return redirect()->route('usuarios.index');
        }
        DB::table('users')->where('id', $id)->update(['estado' => 1]);
        return redirect()->route('usuarios.index');
    }
}
