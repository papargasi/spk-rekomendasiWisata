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
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wisata_id')->constrained('wisatas')->onDelete('cascade');
            $table->decimal('rating', 3, 2);      // Contoh: 4.5
            $table->decimal('jarak', 5, 2);       // Dalam km misalnya
            $table->decimal('kebersihan', 3, 2);  // Skor 1-5
            $table->decimal('nilai_total', 5, 2)->default(0); // Skor SMART
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
