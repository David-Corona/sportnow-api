<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Base\Controller;
use App\Models\Log;
use Illuminate\Http\Request;
use Exception;

class AdminLogsController extends Controller
{
    public function index(Request $request){
        try {
            $logs = Log::with('autor')
            ->whereNull('deleted_at')
            ->filter()
            ->orderBy('created_at','DESC')
            ->get();
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'data' => $logs], 200);
    }
}
