<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('pengaduan', function (Blueprint $table) {
        $table->id();
        $table->string('nik', 16); // NIK maksimal 16 digit
        $table->string('nama', 100);
        $table->string('kecamatan', 100);
        $table->string('kelurahan', 100);
        $table->string('rt', 5);
        $table->string('rw', 5);
        $table->string('judul', 150);
        $table->text('isi'); // isi laporan
        $table->string('bidang', 50); // contoh: Ekonomi, Infrastruktur, Sosial
        $table->json('bukti')->nullable(); // untuk multi upload file
        $table->enum('status', ['dikirim', 'diverifikasi', 'diproses', 'selesai'])->default('dikirim');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('pengaduan');
}

};
