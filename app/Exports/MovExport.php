<?php

namespace App\Exports;

use App\proposal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MovExport implements FromCollection,  WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    function __construct($queryday) {
      
        $this->queryday = $queryday;                         
 }

    public function collection()
    {
        // return proposal::all();
        return $this->queryday; 
    }

    public function headings(): array

    {

        return [ 
            // 'id',          
            'Mov',
            'Poliza',
            'numgru',                        
            'RutTit',
            'dvtit',
            'Rutcar',
            'dvcar',
            'Pat',
            'Mat',
            'Nombres',
            'sex',
            'fnac',
            'isa',
            'obs',                       
            'email',
            'rel',
            'dir',
            'comunas',
            'ciudad',
            'tper',
            'tben',
            'pct',
            'vdesde',
            'vhasta',
            'telf',
            'monrta',
            'renta',
            'prop',            
            'banco',
            'nrocta',
            'vigen',
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
            'fechavt',
            'rutsup',            
            'ejecutivo',
            'llave',
            'uf',
            'peso',
            'est',
            'imc',
            'fechaGestion'            
        ];
        }




}
