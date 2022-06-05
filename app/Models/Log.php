<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $table = 'logs';

    protected $casts = [
        'logable_id' => 'integer',
        'logable_type' => 'string'
    ];


    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function logable()
    {
        return $this->morphTo();
    }

    public function scopeFilter($query)
    {
        if (request('ip')) {
            $query->where('ip', 'like', '%'.request('ip').'%');
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
        if(request('autor')) {
            $query->whereHas('autor', function($q){
                $q->where('name', 'like','%'.request('autor').'%');
            });
        }
        return $query;
    }

}
