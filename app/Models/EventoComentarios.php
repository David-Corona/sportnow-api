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

    public function log()
    {
        return $this->morphMany(Log::class, 'logable');
    }

    public function scopeFilter($query)
    {
        if (request('evento_id')) {
            $query->where('evento_id', request('evento_id'));
        }
        if(request('usuario')) {
            $query->whereHas('autor', function($q){
                $q->where('name', 'ilike','%'.request('usuario').'%');
            });
        }
        if (request('mensaje')) {
            $query->where('mensaje', 'ilike', '%'.request('mensaje').'%');
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
