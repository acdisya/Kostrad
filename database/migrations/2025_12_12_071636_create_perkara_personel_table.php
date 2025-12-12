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
        Schema::create('perkara_personel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perkara_id')->constrained('perkaras')->onDelete('cascade');
            $table->foreignId('personel_id')->constrained('personels')->onDelete('cascade');
            $table->string('peran')->nullable(); // Role in the case (e.g., 'Ketua', 'Anggota', 'Saksi')
            $table->timestamps();

            // Unique constraint to prevent duplicate assignments
            $table->unique(['perkara_id', 'personel_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perkara_personel');
    }
};
