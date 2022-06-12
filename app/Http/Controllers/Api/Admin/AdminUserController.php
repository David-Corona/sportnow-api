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
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'activated'=> $request->activated,
                'role' => $request->role,
            ]);

            if(isset($request->password)) {
                $user->password = bcrypt($request->password);
            }

            if($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $nombreFichero = $file->getClientOriginalName(); // "Nombre Imagen.jpg"
                $nombreAvatar = pathinfo($nombreFichero, PATHINFO_FILENAME); // "Nombre Imagen"
                $extension = $file->getClientOriginalExtension(); //"jpg"
                $nuevoNombre = str_replace(' ', '_', $nombreAvatar).'-'.date('YmdHis').'.'.$extension; //"Nombre_Imagen-20220508115359.jpg"

                $file->storeAs('avatares/', $nuevoNombre, 's3');
                $user->avatar = '/avatares/'.$nuevoNombre;
            }

            $user->save();

        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' => $user], 200);
    }

    public function adminUpdateAvatar(Request $request, $id){

        try {
            if($request->hasFile('avatar')) {

                $file = $request->file('avatar');
                $nombreFichero = $file->getClientOriginalName(); // "Nombre Imagen.jpg"
                $nombreAvatar = pathinfo($nombreFichero, PATHINFO_FILENAME); // "Nombre Imagen"
                $extension = $file->getClientOriginalExtension(); //"jpg"
                $nuevoNombre = str_replace(' ', '_', $nombreAvatar).'-'.date('YmdHis').'.'.$extension; //"Nombre_Imagen-20220508115359.jpg"

                $file->storeAs('avatares/', $nuevoNombre, 's3');

                $user = User::findOrFail($id);
                $user->avatar = '/avatares/'.$nuevoNombre;
                $user->save();

                return response()->json(['status' => 'success', 'data' => $user], 200);
            } else {
                return response()->json(['status' => 'error', 'data' => 'No se ha podido cargar la imagen.'], 200);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'item' => null, 'message' => $e->getMessage()]);
        }
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
                'avatar' => '/avatares/default-avatar.jpg',
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
