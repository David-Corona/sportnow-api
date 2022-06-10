<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Base\EventoController;
use App\Models\Evento;
use Illuminate\Http\Request;
use Exception;
use Carbon\Carbon;

class AdminEventoController extends EventoController
{

    public function update(Request $request, $id){
        $parameters = ["deporte_id", "fecha", "titulo", "descripcion", "direccion", "latitud", "longitud"];
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

    public function ultimosCreados(Request $request){
        $limit = $request->limite ?? 5;
        try {
            $eventos = Evento::with('deporte', 'participantes')
            ->whereNull('deleted_at')
            ->orderBy('created_at','DESC')
            ->limit($limit)
            ->get();
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' => $eventos], 200);
    }

    public function listadoSelect(){
        try {
            $eventos = Evento::with('deporte', 'participantes', 'comentarios')
            ->whereNull('deleted_at')
            ->where('fecha' , '>=' , Carbon::now('Europe/Madrid')->toDateTimeString())
            ->orderBy('id','ASC')
            ->get();

            foreach ($eventos as $evento) {
                $max_participantes = $evento->deporte->max_participantes ?? 1000;
                $numParticipantes = $evento->participantes->count();
                $evento->libre = $numParticipantes < $max_participantes ? true : false;
            };

            $eventos = $eventos->filter(function($item){
                return $item->libre == true;
            });

            $eventos = array_values($eventos->toArray());

        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' => $eventos], 200);
    }


}
