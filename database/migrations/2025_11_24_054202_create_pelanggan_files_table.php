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
        Schema::create('pelanggan_files', function (Blueprint $table) {
    $table->id();
    $table->unsignedInteger('pelanggan_id'); // tipe sama dengan primary key pelanggan
    $table->string('file_path');
    $table->timestamps();

    // Foreign key mengacu ke pelanggan_id
    $table->foreign('pelanggan_id')
          ->references('pelanggan_id')
          ->on('pelanggan')
          ->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan_files');
    }
};
