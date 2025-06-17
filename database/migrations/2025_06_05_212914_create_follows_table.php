<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('follows', function (Blueprint $table) {
        $table->id();

        $table->unsignedBigInteger('seguidor_id'); // El que sigue
        $table->unsignedBigInteger('seguido_id');  // El que es seguido

        $table->timestamps();

        // Claves foráneas (asumiendo que ambos son usuarios)
        $table->foreign('seguidor_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('seguido_id')->references('id')->on('users')->onDelete('cascade');

        // Evitar duplicados
        $table->unique(['seguidor_id', 'seguido_id']);
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};
