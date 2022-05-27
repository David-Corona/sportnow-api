<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, Notifiable, SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password', 'role', 'latitude', 'longitude', 'avatar', 'activated'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function comentarios()
    {
        return $this->hasMany(EventoComentarios::class, 'user_id', 'id');
    }

    public function participantes()
    {
        return $this->hasMany(EventoUsuarios::class, 'user_id','id');
    }

    public function contactos()
    {
        return $this->hasMany(Contacto::class, 'user_id', 'id');
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function scopeFilter($query)
    {
        if (request('name')) {
            $query->where('name','like', '%'.request('name').'%');
        }
        // if (request('direccion')) {
        //     $query->where('direccion', 'like', '%'.request('direccion').'%');
        // }

        // if (request('fecha_inicio') && !request('fecha_fin')) {
        //     $query->whereDate('fecha', '>=', request('fecha_inicio'));
        // }
        // else if (!request('fecha_inicio') && request('fecha_fin')) {
        //     $query->whereDate('fecha', '<=', request('fecha_fin'));
        // }
        // else if (request('fecha_inicio') && request('fecha_fin')) {
        //     $query->whereDate('fecha', '>=', request('fecha_inicio'))
        //     ->whereDate('fecha', '<=', request('fecha_fin'));
        // }

        // if(request('user_id')) {
        //     $query->whereHas('participantes', function($q) use ($request){
        //         $q->where('user_id', '=', $request->user_id);
        //     });
        // }
        return $query;
    }
}
