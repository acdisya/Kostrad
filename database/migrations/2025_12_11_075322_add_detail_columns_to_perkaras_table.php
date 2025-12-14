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
        Schema::table('perkaras', function (Blueprint $table) {
            // Tanggal Pendaftaran (berbeda dengan tanggal_masuk)
            $table->date('tanggal_pendaftaran')->nullable()->after('jenis_perkara');

            // Klasifikasi Perkara (lebih spesifik dari jenis_perkara)
            $table->string('klasifikasi_perkara')->nullable()->after('tanggal_pendaftaran');

            // Para Pihak - Oditur (bisa lebih dari 1)
            $table->json('oditur')->nullable()->after('kategori_id');

            // Para Pihak - Terdakwa (bisa lebih dari 1)
            $table->json('terdakwa')->nullable()->after('oditur');

            // Pasal Dakwaan
            $table->text('pasal_dakwaan')->nullable()->after('terdakwa');

            // Informasi Surat Pelimpahan
            $table->string('nomor_surat_pelimpahan')->nullable()->after('nomor_perkara');
            $table->date('tanggal_surat_pelimpahan')->nullable()->after('nomor_surat_pelimpahan');

            // Tanggal Kejadian
            $table->date('tanggal_kejadian')->nullable()->after('tanggal_pendaftaran');
            $table->string('tempat_kejadian')->nullable()->after('tanggal_kejadian');

            // Skeppera (jika ada)
            $table->string('nomor_skeppera')->nullable()->after('pasal_dakwaan');
            $table->date('tanggal_skeppera')->nullable()->after('nomor_skeppera');
            $table->string('pejabat_skeppera')->nullable()->after('tanggal_skeppera');

            // Surat Dakwaan
            $table->string('nomor_surat_dakwaan')->nullable()->after('pejabat_skeppera');
            $table->date('tanggal_surat_dakwaan')->nullable()->after('nomor_surat_dakwaan');

            // Penyidik Militer (jika ada)
            $table->string('nomor_bap_penyidik')->nullable()->after('tanggal_surat_dakwaan');
            $table->date('tanggal_bap_penyidik')->nullable()->after('nomor_bap_penyidik');

            // Lama Proses (dalam hari)
            $table->integer('lama_proses')->nullable()->after('tanggal_selesai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perkaras', function (Blueprint $table) {
            $table->dropColumn([
                'tanggal_pendaftaran',
                'klasifikasi_perkara',
                'oditur',
                'terdakwa',
                'pasal_dakwaan',
                'nomor_surat_pelimpahan',
                'tanggal_surat_pelimpahan',
                'tanggal_kejadian',
                'tempat_kejadian',
                'nomor_skeppera',
                'tanggal_skeppera',
                'pejabat_skeppera',
                'nomor_surat_dakwaan',
                'tanggal_surat_dakwaan',
                'nomor_bap_penyidik',
                'tanggal_bap_penyidik',
                'lama_proses',
            ]);
        });
    }
};
