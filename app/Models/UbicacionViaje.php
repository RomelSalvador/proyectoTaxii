<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UbicacionViaje extends Model
{
    use HasFactory;

    protected $table = 'ubicaciones_viaje';

    protected $fillable = [
        'viaje_id',
        'lat',
        'lng',
        'velocidad',
        'registrado_en'
    ];

    protected $casts = [
        'registrado_en' => 'datetime',
    ];

    public function viaje()
    {
        return $this->belongsTo(Viaje::class, 'viaje_id');
    }
}
