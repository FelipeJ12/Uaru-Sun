<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('species', function (Blueprint $table) {
            $table->foreignId('main_category_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete()
                ->after('category_id');
        });
    }

    public function down()
    {
        Schema::table('species', function (Blueprint $table) {
            $table->dropConstrainedForeignId('main_category_id');
        });
    }
};
