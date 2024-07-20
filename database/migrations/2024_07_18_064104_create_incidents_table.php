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
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('no_incident',255);
            $table->string('nama_incident',255);
            $table->dateTime('tgl_incident');
            $table->string('lokasi',255);
            $table->float('lat',8,5);
            $table->float('lng',8,5);
            $table->integer('basecamp_id');
            $table->integer('mitra_id');
            $table->integer('material_id');
            $table->integer('jumlah_material');
            $table->string('gambar',100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidents');
    }
};
