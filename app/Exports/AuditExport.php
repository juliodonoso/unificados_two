<?php

namespace App\Exports;

use App\audit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;



class AuditExport implements FromCollection, WithHeadings, WithStyles,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    function __construct($auditorias) {
      
        $this->auditorias = $auditorias;                         
 }



    public function collection()
    {
        // return audit::all();
        return $this->auditorias; 
    }



    public function headings(): array

    {
        return [ 
             'Nro','Sponsor','Canal','Campaña','Rut','Fvta','teloperador','Grab','ejec','faudit',
             'Present (A)','A1','A2','A3','A4','A5',
             'Cob y Cargos (B)','B1','B2','B3','B4',
             'Previo (C)','C1','C2','C3','C4','C5','C6',             
             'Datos (D)','D1','D2','D3','D4','D5','D6','D7','D8',
             'Contrat (E)','E1','E2','E3','E4',                         
             'Info Vta (F)','F1','F2','F3',
             'Info Cualit (G)','G1','G2','G3','G4','G5', 
             'Nota Parcial',                      
             'H1','H2','H3','H4','H5','H6','H7',
             'Nota Final',
             'Estado',            
             'observaciones',
             'mes',
             'anio'
        ];
    }



    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
            1  => ['font' => ['italic' => true]],        

            // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
        ];
    }


    public function registerEvents(): array

    {

        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet
                    ->getDelegate()->getStyle('A1:BM1')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('f2f6f7');
                },
        ];

    }
  


}
