<?php

namespace App\Http\Controllers\Api\Base;

use App\Models\Evento;
use App\Models\EventoUsuarios;
use Illuminate\Http\Request;
use Exception;

class EventoUsuariosController extends Controller
{
    // Store: apuntarse a partido
    // Delete: desapuntarse


    public function store(Request $request) {
        $parameters = ["evento_id", "user_id"];

        // TODO: no permitir mismo usuario al mismo evento

        try {
            $max_participantes = Evento::findOrFail($request->evento_id)->deporte->max_participantes;
            $participantes = Evento::findOrFail($request->evento_id)->participantes->count();

            if ($participantes < $max_participantes) {
                $evento_usuarios = New EventoUsuarios();
                $evento_usuarios->fill($request->only($parameters));
                $evento_usuarios->save();
            } else {
                return response()->json(['status' => 'error', 'message' => 'El evento ha alcanzado el máximo número de participantes'], 400);
            }

        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' =>  $evento_usuarios], 200);
    }


    public function destroy($id) {
        try {
            $evento_usuarios = EventoUsuarios::findOrFail($id);
            $evento_usuarios->delete();
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success'], 200);
    }



}
