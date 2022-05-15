<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Base\EventoUsuariosController;
use App\Models\EventoUsuarios;
use Illuminate\Http\Request;
use Exception;


class AdminEventoUsuariosController extends EventoUsuariosController
{
    //TODO: paginacion para el listado admin, orden?
    //TODO: mas filtros? se puede por prop del with

    public function index(Request $request){
        try {
            $evento_usuarios = EventoUsuarios::with('evento', 'usuario')
            ->whereNull('deleted_at')
            ->filter()
            ->orderBy('evento_id','ASC')
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
        return response()->json(['status' => 'success', 'data' => $evento_usuarios], 200);
    }





}
