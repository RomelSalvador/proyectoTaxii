<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombres',
        'apellidos',
        'correo',
        'telefono',
        'contrasena',
        'rol_id',
        'activo'
    ];

    protected $hidden = ['contrasena'];

    protected $casts = [
        'activo' => 'boolean',
        'correo_verificado_en' => 'datetime',
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    public function conductor()
    {
        return $this->hasOne(Conductor::class, 'usuario_id');
    }

    public function viajesComoPasajero()
    {
        return $this->hasMany(Viaje::class, 'pasajero_id');
    }

    public function viajesComoConductor()
    {
        return $this->hasMany(Viaje::class, 'conductor_id');
    }

    public function calificacionesDadas()
    {
        return $this->hasMany(Calificacion::class, 'evaluador_id');
    }

    public function calificacionesRecibidas()
    {
        return $this->hasMany(Calificacion::class, 'evaluado_id');
    }
}
