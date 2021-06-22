<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table='users';
    protected $primaryKey='id';

    protected $fillable = [
        'nombreCliente', 'apellidoCliente', 'organizacion', 'descripcion', 'prioridad', 'fechaIngreso', 'estado'
    ];
}
