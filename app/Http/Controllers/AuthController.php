<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Generamos la función para registrar usuarios
    public function signup(Request $request)
    {   
        //Validamos campos resividos en el request
        $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);
        //Almacenamos en usuario nuevo en la base de datos
        $user = new User([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->save();
        //Respondemos al SPA
        return response()->json([            
            'message' => 'Usuario creado satisfactoriamente!'], 201);
    }
    public function login(Request $request)
    {
        //Validamos el objeto resivido
        $request->validate([
            'email'       => 'required|string|email',
            'password'    => 'required|string',
            'remember_me' => 'boolean',
        ]);
        //Validamos la autenticación con las credenciales resividas
        $credentials = request(['email', 'password']);
        //SI no son correctas las credenciales:
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Credenciales incorrectas.'], 401);
        }
        //Generamos el Token para ser enviado al SPA
        $user = $request->user();
        $tokenResult = $user->createToken('Token Personal de Acceso');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();
        //Enviamos el token al SPA:
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse(
                $tokenResult->token->expires_at)
                    ->toDateTimeString(),
            'message' => 'Usuario Autenticado Correctamente.'
        ]);
    }

    public function logout(Request $request)
    {   
        //Desvinculamos al usuario del token de acceso:
        $request->user()->token()->revoke();
        return response()->json(['message' => 
            'Has cerrado Sesion correctamente']);
    }

    public function user(Request $request)
    {
        //Retornamos el perfil del usuario
        // return response()->json($request->user());
        return response()->json(User::all());
    }
}
