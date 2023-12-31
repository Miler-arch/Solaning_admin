<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('can:users.index')->only('index');
        $this->middleware('can:users.create')->only('create', 'store');
        $this->middleware('can:users.edit')->only('edit', 'update');
        $this->middleware('can:users.destroy')->only('destroy');
    }
    public function index()
    {
        $users = User::orderBy('id', 'desc')->with('roles')->get();
        $roles = Role::all();
        return view('users.index', compact('users', 'roles'));
    }
    public function create()
    {
        return view('users.create');
    }

    public function store(UserStoreRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'ci' => $request->ci,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);
        $selectedRoles = $request->input('roles', []);
        $user->assignRole($selectedRoles);

        return response()->json(['success' => 'Usuario creado exitosamente.']);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'ci' => $request->ci,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        $selectedRoles = $request->input('roles', []);
        $user->syncRoles($selectedRoles);
        flash()->addSuccess('Usuario actualizado exitosamente', 'Muy Bien!');
        return redirect()->route('users.index', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        flash()->addSuccess('Usuario eliminado exitosamente', 'Muy Bien!');
        return redirect()->route('users.index');
    }
}
