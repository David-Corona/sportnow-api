<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $table = 'logs';

    // protected $fillable = [
    //     "user_id", "mensaje", "ip"
    // ];

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

}
