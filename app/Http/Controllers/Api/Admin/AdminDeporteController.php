<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Base\Controller;
use App\Models\Deporte;
use Illuminate\Http\Request;
use Exception;

class AdminDeporteController extends Controller
{

    public function index(Request $request){
        try {
            $deportes = Deporte::where('deleted_at', null)
            ->filter()
            // ->orderBy('nombre','ASC')
            // ->paginate(20)
            ->get();

            return response()->json(['status' => 'success', 'data' => $deportes], 200);

        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'data' => [], 'message' => $e->getMessage()], 400);
        }
    }


    public function show(Request $request){



    }


    public function store(Request $request){



    }


    public function update(Request $request){



    }


    public function destroy(Request $request){



    }
}
