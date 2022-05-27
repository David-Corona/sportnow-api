<?php

namespace App\Http\Controllers\Api\Base;

use App\Models\Contacto;
use Illuminate\Http\Request;
use Exception;

class ContactoController extends Controller
{

    public function store(Request $request)
    {
        $parameters = ["asunto", "motivo", "asunto", "mensaje", "telefono"];
        try {
            $contacto = New Contacto();
            $contacto->fill($request->only($parameters));
            $contacto->user_id = auth()->user()->id;
            $contacto->save();
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' =>  $contacto], 200);

    }

    // public function store(Request $request){
    //     $parameters = ["deporte_id", "fecha", "titulo", "descripcion", "direccion", "latitud", "longitud", "imagen"];
    //     try {
    //         $evento = New Evento();
    //         $evento->fill($request->only($parameters));
    //         $evento->imagen = $request->imagen ?? $evento->deporte->imagen;
    //         $evento->save();

    //         if ($request->participar) { // Añadir participante
    //             $evento_usuarios = New EventoUsuarios();
    //             $evento_usuarios->evento_id = $evento->id;
    //             $evento_usuarios->user_id = $request->user_id ?? auth()->user()->id;
    //             $evento_usuarios->save();
    //         }
    //     } catch (Exception $e) {
    //         return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
    //     }
    //     return response()->json(['status' => 'success', 'data' =>  $evento], 200);
    // }

}
