<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaniasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campanias1', function (Blueprint $table) {
            $table->id();         
            $table->date('fcarga');      
            $table->string('rut',9);
            $table->string('Apellidop',50);	
            $table->string('contacto',50);
            $table->string('mail',100);
            $table->string('fono',9); 
            $table->string('poliza',100); 
            $table->string('compania',100);    
            $table->string('ramo',100);
            $table->date('inivigencia');
            $table->date('finvigencia');  
            $table->string('moneda',3); 
            $table->decimal('PrimaAfecta', $precision = 8, $scale = 2);
            $table->decimal('PrimaNeta', $precision = 8, $scale = 2);
            $table->integer('pctcomision'); 
            $table->decimal('comision', $precision = 8, $scale = 2);
            $table->string('EjeComercial',100);
            $table->string('Ejegallagher',100);            
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
        Schema::dropIfExists('campanias');
    }
}
