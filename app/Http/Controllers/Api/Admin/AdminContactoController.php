<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Base\ContactoController;
use App\Models\Contacto;
use Illuminate\Http\Request;
use Exception;
use Carbon\Carbon;

class AdminContactoController extends ContactoController
{

    public function index(Request $request){
        try {
            $contacto = Contacto::with('autor')
            ->whereNull('deleted_at')
            ->filter()
            ->orderBy('created_at','ASC')
            ->get();
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' => $contacto], 200);
    }


    public function show($id){
        try {
            $contacto = Contacto::with('autor')->findOrFail($id);
            $contacto->fecha = Carbon::parse($contacto->created_at)->format('d-m-Y h:i:s');
            return response()->json(['status' => 'success', 'data' =>  $contacto], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }

    public function ultimosMensajes(){
        try {
            $mensajes = Contacto::with('autor')
            ->whereNull('deleted_at')
            ->orderBy('created_at','DESC')
            ->limit(5)
            ->get();
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' => $mensajes], 200);
    }

}
