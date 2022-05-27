<?php

namespace App\Http\Controllers\Api\Base;

use App\Models\User;
use App\Models\PasswordResets;
use App\Notifications\PasswordReset;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        // if (!$token = auth($this->active_guard)->attempt($credentials)) {
        if (!$token = JWTAuth::attempt($credentials)) {
           return response()->json(['error' => 'Unauthorized', 'message' => 'Email o contraseña incorrectos.'], 401);
        }

        $user = auth()->user();
        if (isset($request->lat)){
            $user->latitude = $request->lat;
        }
        if (isset($request->lng)){
            $user->longitude = $request->lng;
        }
        $user->save();

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:6',
            'name'  => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }

        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->name = $request->name;
        $user->latitude =  $request->latitude;
        $user->longitude = $request->longitude;
        $user->role = 'user';
        $user->activated = false;
        $user->avatar = '/images/default-avatar.jpg';

        // $user->avatar = isset($request->avatar) ? $request->avatar : '/images/default-avatar.jpg';
        // if($request->hasFile('avatar')) {
        //     $nombreFichero = $request->file('avatar')->getClientOriginalName(); // "Nombre Imagen.jpg"
        //     $nombreAvatar = pathinfo($nombreFichero, PATHINFO_FILENAME); // "Nombre Imagen"
        //     $extension = $request->file('avatar')->getClientOriginalExtension(); //"jpg"
        //     $nuevoNombre = '/uploads/'.str_replace(' ', '_', $nombreAvatar).'-'.date('YmdHis').'.'.$extension; //"Nombre_Imagen-20220508115359.jpg"

        //     // $path = $request->file('avatar')->storeAs(public_path().'/uploads', $nuevoNombre, 'public');
        //     $request->file('avatar')->move(public_path('uploads'), $nuevoNombre); //guarda en public/uploads

        //     $user->avatar = $nuevoNombre;
        // } else {
        //     $user->avatar = '/images/default-avatar.jpg';
        // }

        $user->save();

        return response()->json(['status' => 'success'], 200);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['status' => 'success', 'message' => 'Deslogueado correctamente.']);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $email = $request->email;
        $token = Str::random(64);
        $user = User::where('email', $email)->get()->first();

        if(is_null($user))
        {
            return response()->json(['status' => 'success', 'message' => 'Usuario no encontrado.'], 404);
        }

        PasswordResets::where('email', $email)->delete();
        $r = PasswordResets::create([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $user->notify(new PasswordReset($r->token));

        return response()->json(['status' => 'success', 'message' => 'Email de reseteo de contraseña enviado correctamente.', 'token' => $token], 200);
    }

    public function resetPassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'password'  => 'required|min:6'
        ]);

        if ($validation->fails())
        {
            return response()->json(['status' => 'error', 'errors' => $validation->errors()], 422);
        }

        $token = $request->token;
        $password = $request->password;

        $reset = PasswordResets::where('token',$token)->first();
        if(!$reset)
        {
            return response()->json(['status' => 'error', 'message' => 'El token no es válido o ha caducado.'], 401);
        }

        $user = User::where('email', $reset->email)->get()->first();
        if(!is_null($user))
        {
            $user->password = bcrypt($password);
            $user->save();
            $reset->delete();
            return response()->json(['status' => 'success', 'message' => 'La contraseña se ha modificado correctamente'], 200);
        }
        else
        {
            return response()->json(['status' => 'error', 'message' => 'Usuario no encontrado'], 404);
        }
    }

    public function validateAuth()
    {
        //TODO


        if (auth()->check()) {
            return response()->json(['status' => 'success', 'message' => 'Autorizado'], 200);
        } else {
            // return response()->json(['status' => 'error', 'message' => 'No autorizado'], 401);
            // return false;
            throw new Exception("No autorizado");
        }


        // return auth()->check();
    }

    protected function respondWithToken($token)
    {
        if(auth()->user()->activated !== 1) {
            return response()->json(['error' => 'Desactivado', 'message' => 'Su cuenta está desactivada.'], 40);
        } else {
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
                'user' => auth()->user(),
            ], 200);
        }
    }

}
