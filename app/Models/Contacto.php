<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use SoftDeletes;

    protected $table = "contacto";
    protected $guarded = ["id"];

    protected $fillable = [
        "user_id", "asunto", "motivo", "asunto", "mensaje", "telefono"
    ];


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
        if (request('mensaje')) {
            $query->where('mensaje', 'ilike', '%'.request('mensaje').'%');
        }
        if (request('asunto')) {
            $query->where('asunto', 'ilike', '%'.request('asunto').'%');
        }
        if (request('motivo')) {
            $query->where('motivo', request('motivo'));
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
        if(request('autor')) {
            $query->whereHas('autor', function($q){
                $q->where('name', 'ilike','%'.request('autor').'%');
            });
        }
        return $query;
    }

}
