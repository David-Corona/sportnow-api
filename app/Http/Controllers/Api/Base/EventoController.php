<?php

namespace App\Http\Controllers\Api\Base;

use App\Models\Evento;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;

class EventoController extends Controller
{
    //TODO: filtro distancia en index, ejemplo: partidos radio 50km
    //TODO: paginacion, orden

    public function index(Request $request){
        try {
            $eventos = Evento::with('deporte', 'participantes')
            ->whereNull('deleted_at')
            ->filter()
            ->orderBy('fecha','ASC')
            // ->paginate(20)
            ->get();

            // if(isset($request->page)) {
            //     $languages = Deporte::whereNull('deleted_at')->orderBy('fecha', 'asc')->paginate(15);
            // } else {
            //     $languages = Deporte::whereNull('deleted_at')->orderBy('fecha', 'asc')->get();
            // }


        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' => $eventos], 200);
    }


    public function show($id){
        try {
            $evento = Evento::with('deporte', 'participantes')->findOrFail($id);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' =>  $evento], 200);
    }


    public function store(Request $request){
        $parameters = ["deporte_id", "fecha", "direccion", "latitud", "longitud"];
        try {
            $evento = New Evento();
            $evento->fill($request->only($parameters));
            $evento->save();
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' =>  $evento], 200);
    }

}
