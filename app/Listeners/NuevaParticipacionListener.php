<?php

namespace App\Listeners;

use App\Events\NuevaParticipacion;
use App\Models\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NuevaParticipacionListener
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
     * @param  \App\Events\NuevaParticipacion  $event
     * @return void
     */
    public function handle(NuevaParticipacion $event)
    {
        Log::create([
            'user_id' => auth()->user()->id,
            'ip' => request()->ip(),
            'mensaje' => auth()->user()->name . ' se ha unido a la actividad con id ' . $event->eventoUsuarios->evento_id,
            'logable_id' => $event->eventoUsuarios->id,
            'logable_type' => get_class($event->eventoUsuarios),
        ]);
    }
}
