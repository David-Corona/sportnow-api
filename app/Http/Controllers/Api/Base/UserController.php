<?php

namespace App\Http\Controllers\Api\Base;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    // Route::get('users', [UserController::class, 'index']);
    // Route::get('users/me', [UserController::class, 'me']);
    // Route::put('users/me', [UserController::class, 'update']);
    // // Route::get('users/me/avatar', [UserController::class, 'avatar']);
    // // Route::get('users/me/password', [UserController::class, 'password']);
    // Route::get('users/{id}', [UserController::class, 'show']);


    public function index(Request $request)
    {

        $users = User::where('deleted_at', null)->orderBy('name','ASC')->get();

        return response()->json(['status' => 'success', 'data' => $users], 200);

    }


    public function me(Request $request){

        $user = auth()->user();
        return response()->json(['status' => 'success', 'data' => $user], 200);

    }

    public function show(Request $request){

        $user = User::where('id', $request->id)->get()->first();

        return response()->json(['status' => 'success', 'data' => $user], 200);

    }






}
