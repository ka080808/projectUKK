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
        Schema::create('pbb', function (Blueprint $table) {
            $table->id();
            $table->string('nop', 18)->unique(); // Nomor Objek Pajak
            $table->string('nik_pemilik', 16);
            $table->string('nama_pemilik', 100);
            $table->string('alamat_objek', 255);
            $table->integer('rt');
            $table->integer('rw');
            $table->string('kelurahan', 100);
            $table->string('kecamatan', 100);
            $table->string('kabupaten', 100);
            $table->string('provinsi', 100);
            $table->integer('luas_tanah');
            $table->integer('luas_bangunan')->default(0);
            $table->string('status_tanah'); // Milik Sendiri, Sewa, Hibah
            $table->string('status_bangunan'); // Milik Sendiri, Sewa, Hibah
            $table->string('jenis_bangunan'); // Rumah Tinggal, Gedung, Pabrik, Toko, Gudang, Pertanian, Lainnya
            $table->integer('tahun_perolehan');
            $table->bigInteger('nilai_pajak_tahun_ini');
            $table->string('status_pembayaran')->default('Belum Lunas'); // Lunas, Belum Lunas, Cicilan
            $table->string('keterangan')->nullable();
            $table->timestamps();

            // Foreign key
            $table->foreign('nik_pemilik')->references('nik')->on('warga')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pbb');
    }
};
