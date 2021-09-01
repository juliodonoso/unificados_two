<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Supmetlife extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('supmetlife', function (Blueprint $table) {
            $table->id();
            $table->string('rutsup',9);
            $table->string('dvsup',1);
            $table->string('name',255);
            $table->string('clinica',55);
            $table->string('equipo',35);
            $table->string('telf',9);
            $table->string('email',255);
            $table->timestamps();
        });
        
    }

    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
