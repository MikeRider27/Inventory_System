<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_sucursal');
            $table->text('codigo');
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_vendedor');
            $table->float('impuesto');
            $table->float('neto');
            $table->float('total');
            $table->text('metodo_pago');
            $table->timestamp('fecha')->useCurrent();
            $table->text('estado');
            $table->timestamps();

            // Relaciones (si existen las tablas relacionadas)
            $table->foreign('id_sucursal')->references('id')->on('sucursales')->onDelete('cascade');
            $table->foreign('id_cliente')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('id_vendedor')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
