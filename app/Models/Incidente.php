<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidente extends Model
{
    use HasFactory;

    protected $table = 'incidentes';

    protected $fillable = [
        'viaje_id',
        'reportante_id',
        'tipo',
        'descripcion',
        'gravedad',
        'evidencia_ruta',
        'estado'
    ];

    public function viaje()
    {
        return $this->belongsTo(Viaje::class, 'viaje_id');
    }

    public function reportante()
    {
        return $this->belongsTo(Usuario::class, 'reportante_id');
    }
}
