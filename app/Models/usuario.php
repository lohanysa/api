<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;


use Illuminate\Database\Eloquent\Model;

class usuario extends Authenticatable
{
    protected $fillable = ["correo", "id", "nombre", "pass"];
}
