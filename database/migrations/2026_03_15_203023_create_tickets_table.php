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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('projecte_id')->constrained('projectes')->ondelete('cascade');
            $table->foreignId('creador_id')->constrained('users')->ondelete('cascade');
            $table->string('codi_ticket')->unique();
            $table->string('titol');
            $table->text('descripcio')->nullable();
            $table->enum('estat', ['NOU', 'ASSIGNAT', 'EN_PROGRES', 'EN_REVISIO', 'TANCAT'])->default('NOU');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
