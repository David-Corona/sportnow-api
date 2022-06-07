<?php

namespace App\Http\Controllers\Api\Base;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;


// use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{

    public function index(Request $request)
    {
        try{
            $users = User::where('deleted_at', null)->filter()->orderBy('name','ASC')->get();
            return response()->json(['status' => 'success', 'data' => $users], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'item' => null, 'message' => $e->getMessage()]);
        }
    }

    public function me(){
        try {
            $user = auth()->user();
            return response()->json(['status' => 'success', 'data' => $user, 'me' => true], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'item' => null, 'message' => $e->getMessage()]);
        }
    }

    public function show($id){
        try {
            $user = User::findOrFail($id);
            $isMe = auth()->user()->id==$id ? true : false;
            return response()->json(['status' => 'success', 'data' => $user, 'me' => $isMe], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'item' => null, 'message' => $e->getMessage()]);
        }
    }

    public function updateMe(Request $request){
        try {
            $v = Validator::make($request->all(), [
                'email' => 'required|email',
                'name'  => 'required',
            ]);

            if ($v->fails()) {
                return response()->json(['status' => 'error', 'errors' => $v->errors()], 422);
            }

            $user = auth()->user();
            $user->email = $request->email;
            $user->name = $request->name;
            $user->save();

            return response()->json(['status' => 'success', 'data' => $user], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'item' => null, 'message' => $e->getMessage()]);
        }
    }

    //TODO: Problema con almacenamiento efimero de Heroku
    public function updateAvatar(Request $request){

        try {
            if($request->hasFile('avatar')) {

                $file = $request->file('avatar');
                $nombreFichero = $file->getClientOriginalName(); // "Nombre Imagen.jpg"
                $nombreAvatar = pathinfo($nombreFichero, PATHINFO_FILENAME); // "Nombre Imagen"
                $extension = $file->getClientOriginalExtension(); //"jpg"
                $nuevoNombre = str_replace(' ', '_', $nombreAvatar).'-'.date('YmdHis').'.'.$extension; //"Nombre_Imagen-20220508115359.jpg"

                $file->storeAs('avatares/', $nuevoNombre, 's3');



                $user = auth()->user();
                $user->avatar = '/avatares/'.$nuevoNombre;
                $user->save();





                // $nombreFichero = $request->file('avatar')->getClientOriginalName(); // "Nombre Imagen.jpg"
                // $nombreAvatar = pathinfo($nombreFichero, PATHINFO_FILENAME); // "Nombre Imagen"
                // $extension = $request->file('avatar')->getClientOriginalExtension(); //"jpg"
                // $nuevoNombre = '/uploads/'.str_replace(' ', '_', $nombreAvatar).'-'.date('YmdHis').'.'.$extension; //"Nombre_Imagen-20220508115359.jpg"

                // // $path = $request->file('avatar')->storeAs(public_path().'/uploads', $nuevoNombre, 'public');
                // $request->file('avatar')->move(public_path('uploads'), $nuevoNombre); //guarda en public/uploads

                // $user = auth()->user();
                // $user->avatar = $nuevoNombre;
                // $user->save();

                return response()->json(['status' => 'success', 'data' => $user], 200);
            } else {
                return response()->json(['status' => 'error', 'data' => 'No se ha podido cargar la imagen.'], 200);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'item' => null, 'message' => $e->getMessage()]);
        }
    }


    public function updatePassword(Request $request){
        try {
            $v = Validator::make($request->all(), [
                'password'  => 'required|min:6',
            ]);

            if ($v->fails()) {
                return response()->json(['status' => 'error', 'errors' => $v->errors()], 422);
            }

            $user = auth()->user();
            $user->password = bcrypt($request->password);
            $user->save();

        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'item' => null, 'message' => $e->getMessage()]);
        }
        return response()->json(['status' => 'success', 'data' => $user], 200);
    }
}
