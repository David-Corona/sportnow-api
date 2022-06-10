<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class EventoUsuarios extends Model
{
    use SoftDeletes;
    protected $table = 'evento_usuarios';
    protected $guarded = ['id'];

    protected $fillable = [
        "evento_id", "user_id"
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'evento_id', 'id');
    }

    public function usuario()
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
            $query->whereHas('usuario', function($q){
                $q->where('name', 'like','%'.request('usuario').'%');
            });
        }
        if (request('fecha_inicio') && !request('fecha_fin')) {
            $query->whereHas('evento', function($q){
                $q->whereDate('fecha', '>=', request('fecha_inicio'));
            });
        }
        else if (!request('fecha_inicio') && request('fecha_fin')) {
            $query->whereHas('evento', function($q){
                $q->whereDate('fecha', '<=', request('fecha_fin'));
            });
        }
        else if (request('fecha_inicio') && request('fecha_fin')) {
            $query->whereHas('evento', function($q){
                $q->whereDate('fecha', '>=', request('fecha_inicio'))
                ->whereDate('fecha', '<=', request('fecha_fin'));
            });
        }
        return $query;
    }
}
