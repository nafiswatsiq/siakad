<?php

use App\Models\Kelas;
use App\Models\Prodi;
use App\Models\Semester;
use App\Models\User;
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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(Kelas::class)->constrained();
            $table->foreignIdFor(Prodi::class)->constrained();
            $table->string('jenis_kelamin');
            $table->string('nim');
            $table->foreignIdFor(Semester::class)->constrained();
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->string('no_tlp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
