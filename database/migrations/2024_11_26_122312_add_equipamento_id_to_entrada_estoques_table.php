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
        Schema::table('entrada_estoques', function (Blueprint $table) {
            if (!Schema::hasColumn('entrada_estoques', 'equipamento_id')) {
                $table->unsignedBigInteger('equipamento_id');
            }
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entrada_estoques', function (Blueprint $table) {
            //
        });
    }
};
