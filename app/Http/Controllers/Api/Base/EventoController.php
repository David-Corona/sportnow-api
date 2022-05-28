<?php

namespace App\Http\Controllers\Api\Base;

use App\Models\Evento;
use App\Models\EventoUsuarios;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;

class EventoController extends Controller
{
    //TODO: filtro distancia en index, ejemplo: partidos radio 50km
    //TODO: paginacion, orden - Index+historial

    public function index(Request $request){
        try {
            $eventos = Evento::with('deporte', 'participantes', 'comentarios')
            ->whereNull('deleted_at')
            ->where('fecha' , '>=' , Carbon::now('Europe/Madrid')->toDateTimeString())
            ->filter($request)
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

    public function historial(Request $request){
        try {
            $eventos = Evento::with('deporte', 'participantes')
            ->whereNull('deleted_at')
            ->where('fecha' , '<' , Carbon::now('Europe/Madrid')->toDateTimeString())
            ->filter($request)
            ->orderBy('fecha','ASC')
            ->get();
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' => $eventos], 200);
    }

    public function proximas(Request $request){
        $limit = $request->limite ?? 5;
        try {
            $eventos = Evento::with('deporte', 'participantes')
            ->whereNull('deleted_at')
            ->where('fecha' , '>=' , Carbon::now('Europe/Madrid')->toDateTimeString())
            ->filter($request)
            ->orderBy('fecha','ASC')
            ->limit($limit)
            ->get();
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' => $eventos], 200);
    }


    public function show($id){
        try {
            $evento = Evento::with('deporte', 'participantes.usuario', 'comentarios.autor')->findOrFail($id);
            $userLogged = auth()->user();
            $evento->distancia = $this->calcularDistancia($evento->latitud, $evento->longitud, $userLogged->latitude, $userLogged->longitude);
            $evento->participo = EventoUsuarios::where('evento_id',$id)->where('user_id', $userLogged->id)->get()->isNotEmpty();
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

            if ($request->participar) { // Añadir participante
                $evento_usuarios = New EventoUsuarios();
                $evento_usuarios->evento_id = $evento->id;
                $evento_usuarios->user_id = $request->user_id ?? auth()->user()->id;
                $evento_usuarios->save();
            }
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
