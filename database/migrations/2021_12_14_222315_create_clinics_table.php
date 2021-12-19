<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->string('mov',3);
            $table->string('poliza',15);
            $table->string('numgru',2);
            $table->string('ruttit',15);
            $table->string('dvtit',1);
            $table->string('rutcar',15);
            $table->string('dvcar',1);
            $table->string('pat',50);
            $table->string('mat',50);
            $table->string('nom',50);
            $table->string('sex',2);
            $table->date('fnac');
            $table->string('isa',2);
            $table->string('obs',150);
            $table->string('email',100);
            $table->string('rel',2);
            $table->string('dir',150);
            $table->string('comunas',35);
            $table->string('ciudad',35);
            $table->string('tper',2);
            $table->string('tben',2);
            $table->string('pct',3);
            $table->date('vdesde');
            $table->date('vhasta');
            $table->string('telf',9);
            $table->string('monrta',2);
            $table->string('renta',2);
            $table->string('propuesta',15);
            $table->string('banco',2);
            $table->string('nrocta',25);
            $table->string('vigenciatc',2);
            $table->string('diacob',2);
            $table->string('mescob',2);
            $table->string('rutter',15);
            $table->string('dvter',1);
            $table->string('nombreter',150);
            $table->string('dirter',50);
            $table->string('ciudadter',25);
            $table->string('comunater',25);
            $table->string('telter',15);
            $table->string('ppago',2);
            $table->string('pprega',2);
            $table->string('totaldep',15);
            $table->date('fechadep');
            $table->date('fechavta');
            $table->string('rutsup',15);
            $table->string('ejecutivo',15);
            $table->string('llave',25);
            $table->decimal('uf', $precision = 8, $scale = 2);
            $table->string('peso',10);
            $table->string('estat',10);
            $table->string('imc',10);
            $table->string('supervisor',15);
            $table->string('ejecutiva',35);
            $table->date('fechaent');
            $table->string('clinica',100);
            $table->string('tipo',4);
            $table->string('origen',10);
            $table->string('clasif',10);            
            $table->string('mes',2);
            $table->string('anio',4);                      
            $table->string('prg1',2);
            $table->string('prg2',2);
            $table->string('prg3',2);
            $table->string('prg4',2);
            $table->string('prg5',2);
            $table->string('prg6',2);
            $table->string('prg7',2);
            $table->string('prg8',2);
            $table->string('prg9',2);
            $table->string('prg10',2);           
            $table->integer('emp_id');
            $table->integer('import_id');           
            $table->string('gestion');
            $table->string('tipificacion')->nullable();
            $table->string('subtipif',255); 
            $table->string('gtcall',255);     
            $table->string('observaciones')->nullable();
            $table->boolean('is_mail')->default(false);
            $table->boolean('is_act')->default(false);
            $table->boolean('is_del')->default(false);
            $table->boolean('is_call')->default(false);
            $table->string('auditoria',255);   
            $table->boolean('is_edit')->default(false);
            $table->enum('borrado', ['0', '1']);
            $table->string('pdfscanner');
            $table->boolean('is_adic')->default(false);
            $table->datetime('fechabv');
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
        Schema::dropIfExists('clinics');
    }
}
