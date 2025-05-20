<?php

use App\Models\Mahasiswa;
use App\Models\Semester;
use App\Models\TahunAjaran;
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
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Mahasiswa::class, 'mahasiswa_id')->constrained();
            $table->float('ips')->nullable();
            $table->float('ipk')->nullable();
            $table->foreignIdFor(Semester::class)->constrained();
            $table->foreignIdFor(TahunAjaran::class)->constrained();
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};
