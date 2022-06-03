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

    protected static function boot()
    {
        parent::boot();
        static::deleting(function($model) {
            $model->participantes()->delete();
        });
    }


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
            $query->where('name','ilike', '%'.request('name').'%');
        }
        if (request('email')) {
            $query->where('email','ilike', '%'.request('email').'%');
        }
        if (request('role')) {
            $query->where('role', request('role'));
        }
        if (request('activo')) {
            $query->where('activated', request('activo'));
        }
        return $query;
    }
}
