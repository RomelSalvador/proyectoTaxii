<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    use HasFactory;

    protected $table = 'calificaciones';

    protected $fillable = [
        'viaje_id',
        'evaluador_id',
        'evaluado_id',
        'estrellas',
        'comentario'
    ];

    public function viaje()
    {
        return $this->belongsTo(Viaje::class, 'viaje_id');
    }

    public function evaluador()
    {
        return $this->belongsTo(Usuario::class, 'evaluador_id');
    }

    public function evaluado()
    {
        return $this->belongsTo(Usuario::class, 'evaluado_id');
    }
}
