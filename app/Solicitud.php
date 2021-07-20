<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table ='solicitud';
    protected $primaryKey ='id';

    protected $fillable = [
        'rut', 'nombreCliente', 'apellidoCliente','telefono', 'tipoOrganizacion','nombreOrganizacion' ,'direccion', 'descripcion', 'prioridad','tipoProblema', 'responsable', 'fechaIngreso', 'estado'
    ];

    public function scopeBusqueda($query, $busqueda){
        if ($busqueda) {
            return $query->where('rut', 'like', "%$busqueda%")
            ->orWhere('nombreCliente', 'like', "%$busqueda%")
            ->orWhere('apellidoCliente', 'like', "%$busqueda%");
        }
    }

    public function scopeNombre($query, $nombre){
        if ($nombre) {
            return $query->where('nombreCliente', 'like', "%$nombre%");
        }
    }

    public function scopeApellido($query, $apellido){
        if ($apellido) {
            return $query->where('apellidoCliente', 'like', "%$apellido%");
        }
    }

    public function responsable() {
    return $this->hasOne('App\User', 'id', 'responsable');

    }

    public function detalles() {
        return $this->belongsTo('App\DetalleSolicitud', 'id', 'solicitud', 'many-to-one');
    }
}
