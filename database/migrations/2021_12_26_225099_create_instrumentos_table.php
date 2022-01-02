<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstrumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instrumentos', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250);
            $table->string('descripcion', 150);
            $table->foreignId('id_magnitud')
                ->nullable()
                ->constrained('magnitudes')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('id_marca')
                ->nullable()
                ->constrained('marcas')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('id_pais')
                ->nullable()
                ->constrained('paises')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('id_unidad')
                ->nullable()
                ->constrained('unidades')
                ->cascadeOnUpdate()
                ->nullOnDelete();
                $table->foreignId('id_periodo')
                ->nullable()
                ->constrained('periodos')
                ->cascadeOnUpdate()
                ->nullOnDelete();
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
        Schema::dropIfExists('instrumentos');
    }
}
