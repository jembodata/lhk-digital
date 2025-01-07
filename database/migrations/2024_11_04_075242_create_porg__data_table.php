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
        Schema::create('porg__data', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('nama_plant');
            $table->string('tipe_proses');
            $table->string('nama_mesin');
            $table->string('nama_foreman');
            $table->string('no_op');
            $table->string('type_size');
            $table->string('nama_operator');
            $table->string('bahan_material');
            $table->string('hour_meter');
            $table->string('actual_output');
            $table->string('target_output');
            $table->string('nama_customer');
            $table->string('Status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('porg__data');
    }
};
