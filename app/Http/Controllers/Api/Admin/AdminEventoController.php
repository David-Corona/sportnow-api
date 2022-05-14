<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Base\EventoController;
use App\Models\Evento;
use Illuminate\Http\Request;
use Exception;

class AdminEventoController extends EventoController
{

    public function update(Request $request, $id){
        $parameters = ["deporte_id", "fecha", "direccion", "latitud", "longitud"];
        try {
            $evento = Evento::findOrFail($id);
            $evento->fill($request->only($parameters));
            $evento->save();
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' =>  $evento], 200);
    }


    public function destroy($id){
        try {
            $evento = Evento::findOrFail($id);
            $evento->delete();
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success'], 200);
    }


}
