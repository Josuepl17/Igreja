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
        Schema::create('caixas', function (Blueprint $table) {
            $table->id();
            $table->date('dataini');
            $table->date('datafi');
            $table->string('totalofertas');
            $table->Integer('totaldespesas');
            $table->Integer('totaldizimos');
            $table->Integer('saldo');
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
