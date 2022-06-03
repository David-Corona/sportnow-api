<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class EventoComentarios extends Model
{
    use SoftDeletes;
    protected $table = 'evento_comentarios';
    protected $guarded = ['id'];

    protected $fillable = [
        "evento_id", "user_id", "mensaje"
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'evento_id', 'id');
    }

    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function scopeFilter($query)
    {
        if (request('evento_id')) {
            $query->where('evento_id', request('evento_id'));
        }
        if (request('user_id')) {
            $query->where('user_id', request('user_id'));
        }
        if (request('mensaje')) {
            $query->where('mensaje', 'like', '%'.request('mensaje').'%');
        }
        if (request('fecha_inicio') && !request('fecha_fin')) {
            $query->whereDate('created_at', '>=', request('fecha_inicio'));
        }
        else if (!request('fecha_inicio') && request('fecha_fin')) {
            $query->whereDate('created_at', '<=', request('fecha_fin'));
        }
        else if (request('fecha_inicio') && request('fecha_fin')) {
            $query->whereDate('created_at', '>=', request('fecha_inicio'))
            ->whereDate('created_at', '<=', request('fecha_fin'));
        }
        return $query;
    }
}
