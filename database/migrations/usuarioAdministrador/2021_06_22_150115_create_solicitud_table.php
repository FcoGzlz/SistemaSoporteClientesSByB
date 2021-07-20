<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

class CreateSolicitudTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rut', '12');
            $table->string('nombreCliente', '50');
            $table->string('apellidoCliente', '50');
            $table->string('telefono', '15');
            $table->string('tipoOrganizacion', '10');
            $table->string('nombreOrganizacion', '100')->nullable();
            $table->string('direccion', '100');
            $table->string('descripcion', '500');
            $table->integer('prioridad');
            $table->string('tipoProblema', '20');
            $table->unsignedBigInteger('responsable')->nullable();
            $table->timestamp('fechaIngreso');
            $table->integer('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitud');
    }
}
