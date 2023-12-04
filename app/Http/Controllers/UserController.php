<?php

namespace App\Http\Controllers;

use App\Filters\UserFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $filter = new UserFilter();
        $queryItems = $filter->transform($request);
        $users = User::all();
        $roles = Role::all();

        return view('sistema.users.index', compact('users', 'roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $request->validate([
            'Name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Registra al usuario sin autenticarlo
        $user = new User;
        $user->name = $request->input('Name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->back();
    }

    public function show($id)
    {
        $user = User::find($id);

        if ($user) {
            if (Auth::id() == $user->id) {
                return redirect()->back()->with('error', 'No se puede desactivar un usuario que esté ingresado actualmente en la aplicación');
            } else {
                $user->status = ($user->status == 1) ? 0 : 1;
                $user->save();
            }
        }
        return redirect()->back();
    }


    public function edit($id)
    {
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->input('Name');
        $user->email = $request->has('email');

        if ($request->has('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->update([
            'Name' => $user->name,
            'email' => $user->email,
            'password' => $user->password
        ]);

        $user->save();

        return redirect()->back();
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $usuarios = User::find($id);
        $usuarios->delete();
        return redirect()->back();
        //
    }
}
