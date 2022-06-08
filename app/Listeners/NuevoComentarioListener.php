<?php

namespace App\Listeners;

use App\Events\NuevoComentario;
use App\Models\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NuevoComentarioListener
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
     * @param  \App\Events\NuevoComentario  $event
     * @return void
     */
    public function handle(NuevoComentario $event)
    {
        Log::create([
            'user_id' => auth()->user()->id,
            'ip' => request()->ip(),
            'mensaje' => auth()->user()->name . ' ha realizado un comentario en actividad con id ' . $event->eventoComentarios->evento_id,
            'logable_id' => $event->eventoComentarios->id,
            'logable_type' => get_class($event->eventoComentarios),
        ]);
    }
}
