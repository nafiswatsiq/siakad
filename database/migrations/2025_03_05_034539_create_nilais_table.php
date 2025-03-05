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
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('id_mahasiswa');
            $table->decimal('ips', 3, 2);
            $table->decimal('ipk', 3, 2);
            $table->integer('semester');
            $table->string('tahun_ajaran', 9);
            $table->timestamps();

            // $table->foreign('id_mahasiswa')->references('id')->on('mahasiswa')->onDelete('cascade');
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
