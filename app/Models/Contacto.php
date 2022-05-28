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


    public function scopeFilter($query)
    {
        if (request('user_id')) { //TODO: quizá quiera filtrar por el nombre?
            $query->where('user_id', request('user_id'));
        }
        if (request('mensaje')) {
            $query->where('mensaje', 'like', '%'.request('mensaje').'%');
        }
        if (request('asunto')) {
            $query->where('asunto', 'like', '%'.request('asunto').'%');
        }
        if (request('motivo')) {
            $query->where('motivo', 'like', '%'.request('motivo').'%');
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
