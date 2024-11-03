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
        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->boolean('Cliente');
            $table->timestamps();
        });

        Schema::create('mesas', function (Blueprint $table) {
            $table->id();
            $table->boolean('status');
            $table->integer('quantidadePessoas');
            $table->integer('garcom');
            $table->foreign('garcom')->references('id')->on('pessoas');
            $table->integer('cliente');
            $table->foreign('cliente')->references('id')->on('pessoas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mesas');
    }
};
