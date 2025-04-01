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
        Schema::create('datousuarios', function (Blueprint $table) {
            $table->id();
            $table->string('preferencias')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('alias')->nullable();
            $table->string('telefono')->nullable();
            $table->string('idiomas')->nullable();
            $table->string('deportes')->nullable();
            $table->string('animal_favorito')->nullable();
            $table->string('ocupacion')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datousuarios');
    }
};
