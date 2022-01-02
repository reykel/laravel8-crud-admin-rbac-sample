<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    public function instrumentos(){
        return $this->belongsTo(Instrumento::class, 'id_instrumento');
    }
}
