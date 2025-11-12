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
        Schema::create('id_anggota', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('alamat');
            $table->string('no_hp');
            $table->string('tgl_lahir');
            $table->string('tgl_daftar');
            $table->timestamps();
        });

        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('nama_user');
            $table->string('password');
            $table->enum('role', ['admin', 'user']);
            $table->timestamps();
        });

        Schema::create('denda', function (Blueprint $table) {
            $table->id();
            $table->string('nominal');
            $table->timestamps();
        });

        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('tgl_pinjam');
            $table->string('lama_pinjam');
            $table->integer('nominal_denda');
            $table->foreignId('id_anggota')->constrained('id_anggota')->cascadeOnDelete();
            $table->foreignId('id_denda')->constrained('denda')->cascadeOnDelete();
            $table->foreignId('id_user')->constrained('user')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('kategori_buku', function (Blueprint $table) {
            $table->id();
            $table->string('kategori');
            $table->timestamps();
        });

        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('pengarang');
            $table->string('penerbit');
            $table->integer('tahun');
            $table->integer('isbn');
            $table->string('tgl_input');
            $table->integer('jml_halaman');
            $table->foreignId('id_kategori')->constrained('kategori_buku')->cascadeOnDelete();
            $table->foreignId('id_user')->constrained('user')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('detail_pinjam', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pinjam')->constrained('peminjaman')->cascadeOnDelete();
            $table->string('tgl_kembali');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('id_anggota');
        Schema::dropIfExists('user');
        Schema::dropIfExists('denda');
        Schema::dropIfExists('peminjaman');
        Schema::dropIfExists('id_kategori');
        Schema::dropIfExists('buku');
        Schema::dropIfExists('detail_pinjam');
    }
};
