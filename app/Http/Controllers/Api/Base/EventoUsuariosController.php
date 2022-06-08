<?php

namespace App\Http\Controllers\Api\Base;

use App\Models\Evento;
use App\Models\EventoUsuarios;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;

class EventoUsuariosController extends Controller
{

    public function index(Request $request){
        try {
            $evento_usuarios = EventoUsuarios::with('evento', 'usuario')
            ->whereNull('deleted_at')
            ->filter()
            ->orderBy('evento_id','ASC')
            ->get();
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' => $evento_usuarios], 200);
    }


    public function store(Request $request) {
        try {
            $evento = Evento::with('deporte', 'participantes.usuario', 'comentarios.autor')->findOrFail($request->evento_id);
            $max_participantes = $evento->deporte->max_participantes ?? 1000;
            $numParticipantes = $evento->participantes->count();

            if ($numParticipantes < $max_participantes) {
                $evento_usuarios = New EventoUsuarios();
                $evento_usuarios->user_id = $request->user_id ?? auth()->user()->id;
                $evento_usuarios->evento_id = $request->evento_id;
                $evento_usuarios->save();
                $evento = Evento::with('deporte', 'participantes.usuario', 'comentarios.autor')->findOrFail($request->evento_id);
            } else {
                return response()->json(['status' => 'error', 'message' => 'El evento ha alcanzado el máximo número de participantes'], 400);
            }

        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' => $evento->participantes], 200);
    }


    public function destroy($evento_id, $user_id = null) {
        try {
            $usuarioId = $user_id ?? auth()->user()->id;
            $evento_usuarios = EventoUsuarios::where('evento_id', $evento_id)->where('user_id', $usuarioId)->get()->first();
            $evento_usuarios->delete();

            $evento = Evento::with('deporte', 'participantes.usuario', 'comentarios.autor')->findOrFail($evento_id);
            $participantes = $evento->participantes->count();
            if ($participantes==0) {
                $evento->delete();
                $evento_eliminado = true;
            } else {
                $evento_eliminado = false;
            }

        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' => $evento->participantes, 'evento_eliminado' => $evento_eliminado], 200);
    }

}
