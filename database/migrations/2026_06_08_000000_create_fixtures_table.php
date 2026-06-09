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
        Schema::create('fixtures', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime('started_at');
            $table->foreignId('team_1_id')->constrained('teams')->onDelete('restrict');
            $table->foreignId('team_2_id')->constrained('teams')->onDelete('restrict');
            $table->dateTime('bets_closed_at');
            $table->boolean('is_finished')->default(false);
            $table->foreignId('winning_team_id')->nullable()->constrained('teams')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fixtures');
    }
};
