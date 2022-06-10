<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Base\EventoComentariosController;
use App\Models\EventoComentarios;
use Illuminate\Http\Request;
use Exception;

class AdminEventoComentariosController extends EventoComentariosController
{


    public function show($id){
        try {
            $evento_comentarios = EventoComentarios::with('evento', 'autor')->findOrFail($id);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' =>  $evento_comentarios], 200);
    }


    public function update(Request $request, $id){
        $parameters = ["evento_id", "user_id", "mensaje"];
        try {
            $evento_comentarios = EventoComentarios::findOrFail($id);
            $evento_comentarios->fill($request->only($parameters));
            $evento_comentarios->save();
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' =>  $evento_comentarios], 200);
    }


    public function destroy($id){
        try {
            $evento_comentarios = EventoComentarios::findOrFail($id);
            $evento_comentarios->delete();
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success'], 200);
    }

}
