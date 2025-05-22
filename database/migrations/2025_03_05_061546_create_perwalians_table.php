<?php

use App\Models\Dosen;
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
            $table->foreignIdFor(Dosen::class)->constrained();
            $table->string('perihal');
            $table->string('status')->nullable();
            $table->text('log')->nullable();
            $table->dateTime('jadwal');
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
