<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    use HasFactory;

    public function productos(){
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
