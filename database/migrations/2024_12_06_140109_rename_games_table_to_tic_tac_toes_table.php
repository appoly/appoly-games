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
        Schema::rename('games', 'tic_tac_toes');
        Schema::dropIfExists('games');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('tic_tac_toes', 'games');
        Schema::dropIfExists('tic_tac_toes');
    }
};
