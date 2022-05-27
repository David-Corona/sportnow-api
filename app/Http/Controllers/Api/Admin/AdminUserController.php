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
                // 'password' => bcrypt($request->password),
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                // 'avatar' => $request->avatar,
                'activated'=> $request->activated,
                'role' => $request->role,
            ]);
            if(isset($request->password)) {
                $user->password = bcrypt($request->password);
            }
            // if($request->hasFile('avatar')) {
            //     $nombreFichero = $request->file('avatar')->getClientOriginalName(); // "Nombre Imagen.jpg"
            //     $nombreAvatar = pathinfo($nombreFichero, PATHINFO_FILENAME); // "Nombre Imagen"
            //     $extension = $request->file('avatar')->getClientOriginalExtension(); //"jpg"
            //     $nuevoNombre = '/uploads/'.str_replace(' ', '_', $nombreAvatar).'-'.date('YmdHis').'.'.$extension; //"Nombre_Imagen-20220508115359.jpg"

            //     // $path = $request->file('avatar')->storeAs(public_path().'/uploads', $nuevoNombre, 'public');
            //     $request->file('avatar')->move(public_path('uploads'), $nuevoNombre); //guarda en public/uploads

            //     $user = auth()->user();
            //     $user->avatar = $nuevoNombre;
            //     // $user->save();

            //     return response()->json(['status' => 'success', 'data' => $user], 200);
            // } else {
            //     return response()->json(['status' => 'error', 'data' => 'No se ha podido cargar la imagen.'], 200);
            // }

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
