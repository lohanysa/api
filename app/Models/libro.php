<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class libro extends Model
{
    protected $fillable = ["id","volId", "usuario_id"];
}
