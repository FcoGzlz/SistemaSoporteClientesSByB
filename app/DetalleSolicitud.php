<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleSolicitud extends Model
{
    protected $table = 'detalle_solicitud';
    protected $primaryKey = 'id';

    protected $fillable = [
        'detalle', 'fecha', 'solicitud'
    ];

    public function solicitud() {
        return $this->hasOne('App\solicitud', 'id', 'solicitud');
    }
}
