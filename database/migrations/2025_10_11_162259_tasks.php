<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    protected $connection = 'mysql';
    /**
     * Run the migrations.  
     */


    public function up(): void
    {
        Schema::create('tasks', function(Blueprint $table){
            $table->id();
            $table->string('tarefa');
            $table->dateTime('data_vencimento');
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
