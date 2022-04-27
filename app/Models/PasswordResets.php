<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PasswordResets extends Model
{
    use SoftDeletes;

    protected $table = "password_resets";
    protected $fillable = [
        "email",
        "token",
    ];
    protected $casts = [
        "email" => 'string',
        "token" => 'string',
    ];
}
