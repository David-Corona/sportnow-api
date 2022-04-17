<?php

namespace App\Http\Controllers\Api\Base;

use App\Models\User;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    // private $active_guard = 'users';
    // public $active_guard;
    // public $class;

    // public function __construct()
    // {
    //     $this->middleware('role:users', ['except' => ['login']]);
    // }


    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        // if (!$token = auth($this->active_guard)->attempt($credentials)) {
        if (!$token = JWTAuth::attempt($credentials)) {
           return response()->json(['error' => 'Unauthorized'], 401);
        }

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
            'password'  => 'required|min:6|confirmed',
            'name'  => 'required',
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
        $user->role = 'user';
        $user->save();

        return response()->json(['status' => 'success'], 200);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Deslogueado correctamente.']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user(),
        ]);
    }


    // public function guard()
    // {
    //     return Auth::guard($this->active_guard);
    // }


}
