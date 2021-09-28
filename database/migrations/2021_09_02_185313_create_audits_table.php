<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprdecimal;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->id();
            $table->string('sponsor',55);
            $table->string('campania',55);
            $table->string('opereva',55);
            $table->string('idGrab',150);
            $table->string('rutcli',8);
            $table->string('dvcli',1);
            $table->date('Fgrab');
            $table->date('Fvta');                   
            $table->decimal('PrgA',4,2);
            $table->decimal('PrgA1',4,2);
            $table->decimal('PrgA2',4,2);
            $table->decimal('PrgA3',4,2);
            $table->decimal('PrgA4',4,2);
            $table->decimal('PrgA5',4,2);           
            $table->decimal('PrgB',4,2);
            $table->decimal('PrgB1',4,2);
            $table->decimal('PrgB2',4,2);
            $table->decimal('PrgB3',4,2);
            $table->decimal('PrgB4',4,2);
            $table->decimal('PrgC',4,2);
            $table->decimal('PrgC1',4,2);
            $table->decimal('PrgC2',4,2);
            $table->decimal('PrgC3',4,2);
            $table->decimal('PrgC4',4,2);
            $table->decimal('PrgC5',4,2);
            $table->decimal('PrgC6',4,2);           
            $table->decimal('PrgD',4,2);
            $table->decimal('PrgD1',4,2);
            $table->decimal('PrgD2',4,2);
            $table->decimal('PrgD3',4,2);
            $table->decimal('PrgD4',4,2);
            $table->decimal('PrgD5',4,2);
            $table->decimal('PrgD6',4,2);
            $table->decimal('PrgD7',4,2);
            $table->decimal('PrgD8',4,2);           
            $table->decimal('PrgE',4,2);
            $table->decimal('PrgE1',4,2);
            $table->decimal('PrgE2',4,2);
            $table->decimal('PrgE3',4,2);
            $table->decimal('PrgE4',4,2);           
            $table->decimal('PrgF',4,2);
            $table->decimal('PrgF1',4,2);
            $table->decimal('PrgF2',4,2);
            $table->decimal('PrgF3',4,2);          
            $table->decimal('PrgG',4,2);
            $table->decimal('PrgG1',4,2);
            $table->decimal('PrgG2',4,2);
            $table->decimal('PrgG3',4,2);           
            $table->decimal('PrgH',4,2);
            $table->decimal('PrgH1',4,2);
            $table->decimal('PrgH2',4,2);
            $table->decimal('PrgH3',4,2);
            $table->decimal('PrgH4',4,2);
            $table->decimal('PrgH5',4,2);            
            $table->decimal('Crit',4,2);
            $table->decimal('Crit1',4,2);
            $table->decimal('Crit2',4,2);
            $table->decimal('Crit3',4,2);
            $table->decimal('Crit4',4,2);
            $table->decimal('Crit5',4,2);
            $table->decimal('Crit6',4,2);
            $table->decimal('Crit7',4,2);
            $table->decimal('nfinal',4,2);
            $table->string('Estado',55);
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
       
    }
}
