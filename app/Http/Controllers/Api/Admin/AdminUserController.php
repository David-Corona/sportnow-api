<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Base\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;

class AdminUserController extends UserController
{

    public function update(Request $request, $id){
        try {
            if(isset($request->email)) {
                $usuarios = User::where('email',$request->email)->where('id','!=', $id)->get();
                if(sizeof($usuarios) > 0 ) {
                    return response()->json(['status' => 'error', 'message' => "Ya existe una cuenta con el email introducido"], 409);
                }
            }

            $user = User::findOrFail($id);
            $user->fill([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'role' => $request->role,
                'activated'=> $request->activated,
                'role' => $request->role,
            ]);
            $user->save();

        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' => $user], 200);
    }

    public function activar(Request $request, $id){
        try {
            $user = User::findOrFail($id);
            $user->activated = $request->activated;
            $user->save();
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' => $user], 200);
    }

    public function store(Request $request){

        try {
            if(isset($request->email)) {
                $usuario = User::where('email', $request->email)->get();
                if(sizeof($usuario) > 0)
                    return response()->json(['status' => 'error', 'message' => 'Ya existe una cuenta con el email introducido'], 409);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'role' => $request->role ?? 'user',
                'activated'=> $request->activated ?? true,
                'avatar' => '/images/default-avatar.jpg',
                'created_at' => date('YYYY-MM-DD hh:mm:ss')
            ]);

        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' =>  $user], 200);
    }

    public function destroy($id){
        try {
            $user = User::findOrFail($id);
            $user->delete();
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success'], 200);
    }

}
