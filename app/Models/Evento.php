<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use SoftDeletes;

    protected $table = "eventos";
    protected $guarded = ["id"];

    protected $fillable = [
        "deporte_id", "fecha", "localizacion"
    ];


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

}
