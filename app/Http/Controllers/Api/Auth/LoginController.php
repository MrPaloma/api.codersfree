<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;

class LoginController extends Controller
{
    // Metodo del endpoint que permite autenticar al usuario
    public function store(Request $request)
    {
        // valida el email y el password
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        // busca si el email existe en el modelo, si no es asi falla y envia 404
        $user = User::where('email', $request->email)->firstOrFail();

        // verifica si el password del form y el de la bd son iguales
        if (Hash::check($request->password, $user->password)) {
            // crea un json con un metodo resource de la clase
            return UserResource::make($user);
        } else {
            // envia un mensaje si falla
            return response()->json([
                'message' => 'Credenciales Incorrectas'
            ], 404);
        }
    }
}
