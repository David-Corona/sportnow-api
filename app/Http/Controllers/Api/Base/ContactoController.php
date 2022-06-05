<?php

namespace App\Http\Controllers\Api\Base;

use App\Events\NuevoContacto;
use App\Models\Contacto;
use Illuminate\Http\Request;
use Exception;

class ContactoController extends Controller
{

    public function store(Request $request)
    {
        $parameters = ["asunto", "motivo", "asunto", "mensaje", "telefono"];
        try {
            $contacto = New Contacto();
            $contacto->fill($request->only($parameters));
            $contacto->user_id = auth()->user()->id;
            $contacto->save();
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        event(new NuevoContacto($contacto));
        return response()->json(['status' => 'success', 'data' =>  $contacto], 200);
    }

}
