<?php

use App\Models\Matkul;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nilai_matkuls', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Mahasiswa::class)->constrained();
            $table->foreignIdFor(Matkul::class)->constrained();
            $table->decimal('nilai', 5, 2);
            $table->timestamps();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_matkuls');
    }
};
