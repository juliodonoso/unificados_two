<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proposal extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "proposals";  

    protected $fillable = [  
            'id',          
            'mov',
            'poliza',
            'numgru',
            'ruttit',
            'dvtit',
            'rutcar',
            'dvcar',
            'pat' ,
            'mat',
            'nom', 
            'sex',      
            'fnac',
            'isa', 
            'obs', 
            'email', 
            'rel', 
            'dir', 
            'comunas', 
            'ciudad', 
            'tper' , 
            'tben', 
            'pct',
            'vdesde',
            'vhasta', 
            'telf', 
            'monrta', 
            'renta', 
            'propuesta', 
            'banco', 
            'nrocta', 
            'vigenciatc', 
            'diacob', 
            'mescob', 
            'rutter', 
            'dvter', 
            'nombreter', 
            'dirter', 
            'ciudadter', 
            'comunater', 
            'telter', 
            'ppago', 
            'pprepa', 
            'totaldep',         
            'fechadep',
            'fechavta',            
            'rutsup', 
            'ejecutivo', 
            'llave', 
            'uf', 
            'peso', 
            'estat' , 
            'imc', 
            'supervisor', 
            'ejecutiva', 
            'fechaent',
            'clinica', 
            'tipo', 
            'origen',
            'clasif',
            'mes',
            'anio',
            'prg1',
            'prg2',
            'prg3',
            'prg4',
            'prg5',
            'prg6',
            'prg7',
            'prg8',
            'prg9',
            'prg10',
            'emp_id',
            'import_id',
            'gestion',
            'tipificacion',
            'subtipif',
            'gtcall',
            'tpcall',
            'observaciones',
            'is_mail',
            'is_act',
            'is_call',
            'borrado',            
            'updated_at'
            
        ];


        public function getFechacreaFormatAttribute()
        {
            return \Carbon\Carbon::parse($this->fechacrea)->formatLocalized('%d de %B de %Y');
        }



}
