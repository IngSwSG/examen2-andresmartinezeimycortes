<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('material_unidads', function (Blueprint $table) {
            $table->id('idMaterialUnidad');
            $table->integer('cantidad');

            $table->unsignedBigInteger('unidad_id');
            $table->unsignedBigInteger('codigo_material');
            $table->unsignedBigInteger('codigoPresupuesto');

            $table->timestamps();

            // Relaciones
            $table->foreign('unidad_id')->references('id')->on('unidades')->onDelete('cascade');
            $table->foreign('codigo_material')->references('codigo')->on('materials')->onDelete('cascade');
            $table->foreign('codigoPresupuesto')->references('codigoPresupuesto')->on('presupuestos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_unidads');
    }
};
