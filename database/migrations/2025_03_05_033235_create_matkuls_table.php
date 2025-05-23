<?php

use App\Models\Dosen;
use App\Models\Ruangan;
use App\Models\Semester;
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
        Schema::create('matkuls', function (Blueprint $table) {
            $table->id();
            $table->string('kode_matkul')->unique();
            $table->string('nama');
            $table->integer('sks');
            $table->integer('kuota');
            $table->string('sesi');
            $table->foreignIdFor(Ruangan::class)->constrained();
            $table->foreignIdFor(Dosen::class)->constrained();
            $table->foreignIdFor(Semester::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matkuls');
    }
};
