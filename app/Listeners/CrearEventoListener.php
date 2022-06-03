<?php

namespace App\Listeners;

use App\Events\CrearEvento;
use App\Models\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CrearEventoListener
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
     * @param  \App\Events\CrearEvento  $event
     * @return void
     */
    public function handle(CrearEvento $event)
    {
        Log::create([
            'user_id' => auth()->user()->id,
            'ip' => request()->ip(),
            'mensaje' => 'Nueva actividad creada por el usuario ' . auth()->user()->name,
            'logable_id' => $event->evento->id,
            'logable_type' => get_class($event->evento),
        ]);
    }
}
