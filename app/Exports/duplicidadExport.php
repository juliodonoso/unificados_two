<?php

namespace App\Exports;

use App\proposal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;


class duplicidadExport implements FromCollection,  WithHeadings,WithStrictNullComparison, WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */
    function __construct($propuestas) {
      
        $this->propuestas = $propuestas;                         
 }

    public function collection()
    {
        // return Proposal::all();
        return $this->propuestas;    
       
    }
    public function headings(): array

    {

        return [ 
            'numgru',
            'RutTit',
            'dvtit',
            'Rutcar',
            'dvcar',
            'Pat',
            'Mat',
            'nom',
            'sex',
            'fnac',
            'rel',
            'propuesta',
            'rutter',
            'dvter',
            'nombreter',
            'fechavta',
            'rutsup',
            'ejecutivo',
            'llave',
            'uf',
            'supervisor',
            'ejecutiva',
            'fechaent',
            'clinica',
            'tipo',
            'origen',
            'clasif',
            'observaciones'             
            
        ];

    }

    
}
