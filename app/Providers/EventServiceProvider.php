<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Events\CrearEvento;
use App\Events\NuevaParticipacion;
use App\Events\NuevoComentario;
use App\Events\NuevoContacto;
use App\Events\NuevoUsuario;
use App\Listeners\CrearEventoListener;
use App\Listeners\NuevaParticipacionListener;
use App\Listeners\NuevoComentarioListener;
use App\Listeners\NuevoContactoListener;
use App\Listeners\NuevoUsuarioListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CrearEvento::class => [
            CrearEventoListener::class
        ],
        NuevoContacto::class => [
            NuevoContactoListener::class
        ],
        NuevoUsuario::class => [
            NuevoUsuarioListener::class
        ],
        NuevaParticipacion::class => [
            NuevaParticipacionListener::class
        ],
        NuevoComentario::class => [
            NuevoComentarioListener::class
        ],


    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
