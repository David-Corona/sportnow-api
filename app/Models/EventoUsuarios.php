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
}
