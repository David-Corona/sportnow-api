<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Base\Controller;
use App\Models\Deporte;
use Illuminate\Http\Request;
use Exception;

class AdminDeporteController extends Controller
{

    //TODO: ordenar? paginar?
    public function index(Request $request){
        try {
            $deportes = Deporte::whereNull('deleted_at')
            ->filter()
            // ->orderBy('nombre','ASC')
            // ->paginate(20)
            ->get();

            // if(isset($request->page)) {
            //     $languages = Deporte::whereNull('deleted_at')->orderBy('name', 'asc')->paginate(15);
            // } else {
            //     $languages = Deporte::whereNull('deleted_at')->orderBy('name', 'asc')->get();
            // }


        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' => $deportes], 200);
    }


    public function show($id){
        try {
            $deporte = Deporte::findOrFail($id);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' =>  $deporte], 200);
    }


    public function store(Request $request){
        $parameters = ["nombre", "max_participantes"];
        try {
            $deporte = New Deporte();
            $deporte->fill($request->only($parameters));
            $deporte->save();
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' =>  $deporte], 200);
    }


    public function update(Request $request, $id){
        $parameters = ["nombre", "max_participantes"];
        try {
            $deporte = Deporte::findOrFail($id);
            $deporte->fill($request->only($parameters));
            $deporte->save();
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' =>  $deporte], 200);
    }


    public function destroy($id){
        try {
            $deporte = Deporte::findOrFail($id);
            $deporte->delete();
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success'], 200);
    }
}
