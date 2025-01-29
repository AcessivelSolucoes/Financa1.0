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
        Schema::create('dividas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // Relacionamento com a tabela de usuários (clientes)
            $table->decimal('valor', 10, 2); // Valor da dívida
            $table->date('vencimento'); // Data de vencimento
            $table->string('status')->default('pendente'); // Status da dívida (pendente por padrão)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dividas');
    }
};
