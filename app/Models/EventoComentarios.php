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
}
