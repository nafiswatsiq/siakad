<?php

use App\Models\dosen;
use App\Models\Mahasiswa;
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
        Schema::create('perwalians', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Mahasiswa::class)->constrained();
            $table->foreignIdFor(dosen::class)->constrained();
            $table->string('status')->nullable();
            $table->string('log')->nullable();
            $table->string('jadwal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perwalians');
    }
};
