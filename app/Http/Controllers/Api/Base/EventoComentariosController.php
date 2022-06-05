<?php

namespace App\Http\Controllers\Api\Base;

use App\Models\EventoComentarios;
use Illuminate\Http\Request;
use Exception;

class EventoComentariosController extends Controller
{

    public function index(Request $request){
        try {
            $evento_comentarios = EventoComentarios::with('evento', 'autor')
            ->whereNull('deleted_at')
            ->filter()
            ->orderBy('created_at','ASC')
            ->get();
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' => $evento_comentarios], 200);
    }


    public function store(Request $request){
        $parameters = ["evento_id", "user_id", "mensaje"];
        try {
            $evento_comentarios = New EventoComentarios();
            $evento_comentarios->fill($request->only($parameters));
            $evento_comentarios->user_id = $request->user_id ?? auth()->user()->id;
            $evento_comentarios->save();
            $evento_comentarios->autor = auth()->user();
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' =>  $evento_comentarios], 200);
    }

}
