<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viaje extends Model
{
    use HasFactory;

    protected $table = 'viajes';

    protected $fillable = [
        'pasajero_id',
        'conductor_id',
        'origen_lat',
        'origen_lng',
        'destino_lat',
        'destino_lng',
        'direccion_origen',
        'direccion_destino',
        'estado',
        'inicio_en',
        'fin_en'
    ];

    protected $casts = [
        'inicio_en' => 'datetime',
        'fin_en' => 'datetime',
    ];

    public function pasajero()
    {
        return $this->belongsTo(Usuario::class, 'pasajero_id');
    }

    public function conductor()
    {
        return $this->belongsTo(Usuario::class, 'conductor_id');
    }

    public function ubicaciones()
    {
        return $this->hasMany(UbicacionViaje::class, 'viaje_id');
    }

    public function incidentes()
    {
        return $this->hasMany(Incidente::class, 'viaje_id');
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class, 'viaje_id');
    }
}
