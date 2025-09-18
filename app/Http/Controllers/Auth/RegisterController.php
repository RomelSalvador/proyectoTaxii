<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombres'   => ['required', 'string', 'max:100'],
            'apellidos' => ['required', 'string', 'max:100'],
            'correo'    => ['required', 'string', 'email', 'max:255', 'unique:usuarios,correo'],
            'telefono'  => ['nullable', 'string', 'max:15'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
            'rol_id'    => ['required', 'exists:roles,id'],
        ]);
    }

    protected function create(array $data)
    {
        return Usuario::create([
            'nombres'   => $data['nombres'],
            'apellidos' => $data['apellidos'],
            'correo'    => $data['correo'],
            'telefono'  => $data['telefono'] ?? null,
            'contrasena'=> Hash::make($data['password']),
            'rol_id'    => $data['rol_id'],
        ]);
    }
}
