<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deporte extends Model
{
    use SoftDeletes;

    protected $table = "deportes";
    protected $guarded = ["id"];

    protected $fillable = [
        "nombre", "max_participantes", "imagen"
    ];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function($model) {
            $model->eventos()->delete();
        });
    }

    public function eventos()
    {
        return $this->hasMany(Evento::class, 'deporte_id', 'id');
    }

    public function scopeFilter($query)
    {
        if (request('nombre')) {
            $query->where('nombre', 'ilike', '%'.request('nombre').'%');
        }
        if (request('max_participantes')) {
            $query->where('max_participantes', request('max_participantes'));
        }
        return $query;
    }

}
