<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('plantas_medicinales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('nombre_cientifico', 100)->nullable();
            $table->text('usos')->nullable();
            $table->text('habitat')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plantas_medicinales');
    }
};
