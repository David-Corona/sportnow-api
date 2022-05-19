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
            $eventos = Evento::with('deporte', 'participantes', 'comentarios')
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
            $evento = Evento::with('deporte', 'participantes.usuario', 'comentarios.autor')->findOrFail($id);
            $evento->distancia = $this->calcularDistancia($evento->latitud, $evento->longitud, auth()->user()->latitude, auth()->user()->longitude);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' =>  $evento], 200);
    }


    public function store(Request $request){
        $parameters = ["deporte_id", "fecha", "titulo", "descripcion", "direccion", "latitud", "longitud"];
        try {
            $evento = New Evento();
            $evento->fill($request->only($parameters));
            $evento->save();
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' =>  $evento], 200);
    }


    protected function calcularDistancia($lat1, $long1, $lat2, $long2)
    {
        $latitud1 = deg2rad($lat1);
        $longitud1 = deg2rad($long1);
        $latitud2 = deg2rad($lat2);
        $longitud2 = deg2rad($long2);

        $difLatitud = $latitud2 - $latitud1;
        $difLongitud = $longitud2 - $longitud1;

        $angulo = 2 * asin(sqrt(pow(sin($difLatitud / 2), 2) +
            cos($latitud1) * cos($latitud2) * pow(sin($difLongitud / 2), 2)));

        return $angulo * 6371; // en km
      }



}
