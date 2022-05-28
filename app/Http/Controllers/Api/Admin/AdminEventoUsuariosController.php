<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Base\EventoUsuariosController;
use App\Models\EventoUsuarios;
use Illuminate\Http\Request;
use Exception;


class AdminEventoUsuariosController extends EventoUsuariosController
{

    public function masActivos(Request $request)
    {
        $usuariosActivos = [];
        try {
            $usuariosActivos = EventoUsuarios::with(["usuario"])
            ->selectRaw('user_id, COUNT(user_id) AS total')
            ->whereNull('deleted_at')
            ->groupBy('user_id')
            ->orderBy("total", "desc")
            ->limit(5)
            ->get();
        } catch(Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' => $usuariosActivos], 200);
    }



}
