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
        Schema::create('pedido_cab', function (Blueprint $table) {
            $table->id();
            $table->integer('id_cliente');
            $table->foreign('id_cliente')->references('id')->on('pessoas');
            $table->integer('id_funcionario');
            $table->foreign('id_funcionario')->references('id')->on('pessoas');
            $table->integer('id_mesa');
            $table->boolean('pedido_aberto');
            $table->timestamps();
        });

        Schema::create('pedido_det', function (Blueprint $table) {
            $table->id();
            $table->integer('id_produto');
            $table->foreign('id_produto')->references('id')->on('produtos');
            $table->integer('id_pedido');
            $table->foreign('id_pedido')->references('id')->on('pedido_cab');
            $table->integer('quantidade');
            $table->float('preco');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_cab');
        Schema::dropIfExists('pedido_det');
    }
};
