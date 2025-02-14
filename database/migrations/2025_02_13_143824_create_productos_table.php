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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_categoria')->constrained('categorias');
            $table->string('descripcion');
            $table->string('codigo')->unique();
            $table->decimal('precio_compra', 10, 2);
            $table->decimal('precio_venta', 10, 2);
            $table->integer('stock');
            $table->string('imagen')->nullable();
            $table->timestamp('agregado')->nullable(); // ✅ Definido correctamente
            $table->integer('ventas')->default(0);
            $table->timestamps(); // ✅ Esto crea created_at y updated_at correctamente
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
