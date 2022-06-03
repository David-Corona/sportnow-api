<?php

namespace App\Listeners;

use App\Events\NuevoContacto;
use App\Models\Contacto;
use App\Models\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NuevoContactoListener
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
     * @param  \App\Events\NuevoContacto  $event
     * @return void
     */
    public function handle(NuevoContacto $event)
    {
        Log::create([
            'user_id' => auth()->user()->id,
            'ip' => request()->ip() ?? '0.0.0.0',
            'mensaje' => 'Nueva mensaje de contacto enviado por el usuario ' . auth()->user()->name,
            'logable_id' => $event->contacto->id,
            'logable_type' => get_class($event->contacto),
        ]);
    }
}
