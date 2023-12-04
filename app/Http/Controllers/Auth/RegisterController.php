<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RegisterController extends Controller
{
  use RegistersUsers;

  protected $redirectTo = RouteServiceProvider::HOME;

  public function __construct()
  {
    $this->middleware('guest');
  }

  public function index()
  {
    $usuarios = User::all();
    return view('usuarios.index', compact('usuarios'));
  }

  protected function validator(array $data)
  {
    return Validator::make($data, [
      'Name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
  }

  protected function create(array $data)
  {
    $user = User::create([
      'Name' => $data['Name'],
      'email' => $data['email'],
      'password' => Hash::make($data['password']),
    ]);

    // Verifica si hay usuarios registrados
    if (User::count() === 1) {
      // Crea el rol 'Admin' y el permiso 'Admin Configuracion' si no existen
      $role = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
      $permission = Permission::firstOrCreate(['name' => 'Admin Configuracion', 'guard_name' => 'web']);

      // Asigna el permiso al rol
      $role->givePermissionTo($permission);

      // Asigna el rol al usuario
      $user->assignRole($role);
    }

    return $user;
  }

  protected function registered()
  {
    $this->guard()->logout();

    return redirect('/login');
  }
}
