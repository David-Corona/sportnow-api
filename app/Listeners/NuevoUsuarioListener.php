<?php

namespace App\Listeners;

use App\Events\NuevoUsuario;
use App\Models\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NuevoUsuarioListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NuevoUsuario  $event
     * @return void
     */
    public function handle(NuevoUsuario $event)
    {
        Log::create([
            'user_id' => $event->usuario->id,
            'ip' => request()->ip() ?? '0.0.0.0',
            'mensaje' =>  $event->usuario->name . ' se ha registrado',
            'logable_id' => $event->usuario->id,
            'logable_type' => get_class($event->usuario),
        ]);
    }
}
