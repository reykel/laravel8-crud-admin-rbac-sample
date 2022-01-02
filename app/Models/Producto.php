<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public function categorias(){
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function cursos(){
        return $this->hasMany(Curso::class, 'id');
    }
}
