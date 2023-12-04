<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CustomAuthController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login'); // Redirige a la página de inicio de sesión
    }
}

