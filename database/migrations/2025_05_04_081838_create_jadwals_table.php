<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //Schema::create('jadwals', function (Blueprint $table) {
            //$table->id();
            //$table->foreignId('kelas_id')->constrained()->onDelete('cascade');
            //$table->foreignId('pelajaran_id')->constrained()->onDelete('cascade');
            //$table->foreignId('guru_id')->constrained('users')->onDelete('cascade');
            //$table->string('hari'); // contoh: Senin, Selasa
            //$table->time('jam_mulai');
            //$table->time('jam_selesai');
            //$table->timestamps();
        //});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
}