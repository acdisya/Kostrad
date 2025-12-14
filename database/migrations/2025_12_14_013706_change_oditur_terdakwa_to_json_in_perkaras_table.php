<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('perkaras', function (Blueprint $table) {
            // Ubah kolom menjadi JSON
            $table->json('oditur')->nullable()->change();
            $table->json('terdakwa')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('perkaras', function (Blueprint $table) {
            $table->text('oditur')->nullable()->change();
            $table->text('terdakwa')->nullable()->change();
        });
    }
};
