<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
    use HasFactory;

    protected $table = 'conductores';

    protected $fillable = [
        'usuario_id',
        'dni',
        'licencia_numero',
        'licencia_vencimiento',
        'placa_vehiculo',
        'modelo_vehiculo',
        'verificado',
        'fecha_verificacion',
        'documentos'
    ];

    protected $casts = [
        'documentos' => 'array',
        'verificado' => 'boolean',
        'fecha_verificacion' => 'datetime',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function capacitaciones()
    {
        return $this->hasMany(Capacitacion::class, 'conductor_id');
    }
}
