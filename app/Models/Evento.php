<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Evento extends Model
{
    use SoftDeletes;

    protected $table = "eventos";
    protected $guarded = ["id"];

    protected $fillable = [
        "deporte_id", "titulo", "descripcion", "fecha", "direccion", "latitud", "longitud", "imagen"
    ];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function($model) {
            $model->participantes()->delete();
            $model->comentarios()->delete();
        });
    }


    public function deporte()
    {
        return $this->belongsTo(Deporte::class, 'deporte_id', 'id');
    }

    public function comentarios()
    {
        return $this->hasMany(EventoComentarios::class, 'evento_id','id');
    }

    public function participantes()
    {
        return $this->hasMany(EventoUsuarios::class, 'evento_id','id');
    }


    public function scopeFilter($query)
    {
        if (request('deporte_id')) { //TODO: quizá quiera filtrar por el nombre?
            $query->where('deporte_id', request('deporte_id'));
        }
        if (request('direccion')) {
            $query->where('direccion', 'like', '%'.request('direccion').'%');
        }
        if (request('fecha_inicio') && !request('fecha_fin')) {
            $query->whereDate('fecha', '>=', request('fecha_inicio'));
        }
        else if (!request('fecha_inicio') && request('fecha_fin')) {
            $query->whereDate('fecha', '<=', request('fecha_fin'));
        }
        else if (request('fecha_inicio') && request('fecha_fin')) {
            $query->whereDate('fecha', '>=', request('fecha_inicio'))
            ->whereDate('fecha', '<=', request('fecha_fin'));
        }
        return $query;
    }

}
