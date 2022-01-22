<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProspectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospectos', function (Blueprint $table) {

            //
            $table->id();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('nombre_1', 50);
            $table->string('nombre_2', 50);
            $table->string('apellido_1', 50);
            $table->string('apellido_2', 50);
            $table->decimal('cedula')->unique();
            $table->decimal('celular', 10);
            $table->string('correo', 100);
            $table->string('estado_civil', 100);
            $table->boolean('aplica_subsidio')->default(0);
            $table->string('caja_compensacion', 50);
            $table->string('actividad', 50);
            $table->decimal('ingresos')->default(0);
            $table->decimal('gastos')->default(0);
            $table->decimal('primas_proyectadas')->default(0);
            $table->decimal('cesantias')->default(0);
            $table->decimal('cesantias_proyectadas')->default(0);
            $table->decimal('ahorros')->default(0);
            $table->decimal('ahorros_proyectados')->default(0);
            $table->decimal('activos')->default(0);
            $table->decimal('pasivos')->default(0);
            $table->decimal('credito')->default(0);
            $table->json('documentos_cliente');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prospectos');
    }
}
