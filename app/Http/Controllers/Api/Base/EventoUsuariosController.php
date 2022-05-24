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
                // $evento_usuarios->user_id = $request->user_id ?? auth()->user()->id;
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


    public function destroy($evento_id, $user_id) {
        try {
            $evento = Evento::findOrFail($evento_id);
            $usuario = $user_id ?? auth()->user()->id;
            $evento_usuarios = EventoUsuarios::where('evento_id', $evento_id)->where('user_id', $usuario)->get()->first();
            $evento_usuarios->delete();

            $participantes = $evento->participantes->count();
            if ($participantes==0) {
                $evento->delete();
            }

        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success'], 200);
    }



}
