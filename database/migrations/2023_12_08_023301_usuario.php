<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Constraint\Constraint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            $table->string('nome');
            $table->string('funcao');
            $table->string('endereco');
            $table->string('telefone');
            $table->timestamps();

            
        });




    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
