<?php

namespace App\Exports;
use App\Models\proposal;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProposalExport implements FromCollection,  WithHeadings
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
            'numgru','RutTit','dvtit','Rutcar','dvcar','Pat','Mat','nom',
            'sex','fnac','obs','rel','telf','propuesta','banco','nrocta','rutter','dvter','nombreter',
            'fechavta','rutsup','ejecutivo','llave','uf','supervisor','ejecutiva','fechaent','clinica','tipo','origen','clasif',            
            'Gestion Auditoria',
            'tipif Auditoria',
            'sub-tipif',
            'Gestion llamada',
            'tipif llamada',
            'Banco',
            'observaciones',
        ];

    }
    
}


