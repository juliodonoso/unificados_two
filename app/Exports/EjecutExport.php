<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class EjecutExport implements FromCollection, WithHeadings, WithStyles,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    function __construct($ejecutivos) {
      
        $this->ejecutivos = $ejecutivos;                         
    }



    public function collection()
    {
        //
        return $this->ejecutivos; 
    }


    public function headings(): array

    {
        return [ 
             'Sponsor','Canal','Campaña','Operador','alertas','Cumple','%Parcial','%Final','Total','%Cumpl','Auditor'
        ];
    }



    public function styles(Worksheet $sheet)
    {
        return [
          
            1    => ['font' => ['bold' => true]],        
            1  => ['font' => ['italic' => true]],  
          
        ];
    }


    public function registerEvents(): array

    {

        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet
                    ->getDelegate()->getStyle('A1:K1')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('f2f6f7');
                },
        ];

    }
}
