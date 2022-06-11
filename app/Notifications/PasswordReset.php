<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\PasswordResets;

class PasswordReset extends Notification
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $data = PasswordResets::where('token',$this->token)->first();

        return (new MailMessage)
        ->greeting('¡Hola!')
        ->subject('Recuperación de contraseña')
        ->line('Has recibido este email porque has solicitado la recuperación de contraseña de tu cuenta.')
        ->action('Resetear contraseña','https://sportnow.netlify.app/auth/reset-password/' . $this->token)
        ->line('Si no has sido tú, puedes ignorar este email.')
        ->salutation("SportNow");
    }

    public function toArray($notifiable)
    {
        return [

        ];
    }
}
