<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;



class ConceptsExport implements FromCollection, WithHeadings, WithStyles,ShouldAutoSize,WithEvents,WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */

    function __construct($conceptos) {
      
        $this->conceptos = $conceptos;                         
    }

    public function collection()
    {
        //
        return $this->conceptos;
    }


    public function headings(): array

    {
        return [ 
            'Nro','Campaña','Rut cliente','Fecha vta','teloperador',' Id Grab','ejec','fecha audit',
            'Present(A) %','A1','A2','A3','A4','A5',
            'Cob y Cargos(B) %','B1','B2','B3','B4',
            'Previo(C) %','C1','C2','C3','C4','C5','C6',             
            'Datos(D) %','D1','D2','D3','D4','D5','D6','D7','D8',
            'Contrat(E) %','E1','E2','E3','E4',                         
            'Info Vta(F) %','F1','F2','F3',
            'Info Cualit(G) %','G1','G2','G3','G4','G5', 
            'Nota Parcial %',                      
            'H1','H2','H3','H4','H5','H6','H7',
            'Nota Final %',
            'Estado',            
            'observaciones',
            'Apelacion',
            'ComentCallCenter',
            'AuditorCallCenter',
            'ResolBECS',
            'AccionesBECS',
            'ComentCia',
            'mes',
            'anio',
            'Sponsor',
            'Canal'            

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
                    ->getDelegate()->getStyle('A1:BI1')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('f2f6f7');
                    
                    $event->sheet
                    ->getDelegate()->getStyle('BJ1:BO1')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('b1f1b1'); 

                    $event->sheet
                    ->getDelegate()->getStyle('BP1:BS1')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('f2f6f7');

                    $styleArray = [
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'color' => ['rgb' => 'f2f6f7']
                        ],
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        ],                       
                    ];

                  $stilo = ['I','O','T','AA','AJ','AO','AS','AY','BG'];
                   foreach ($stilo as $k) {                                    
                       $event->sheet->getStyle($k)->applyFromArray($styleArray);
                   }
                   $event->sheet->getColumnDimension('BI')->setAutoSize(false);
                   $event->sheet->getColumnDimension('BI')->setWidth(100);     

               
                              
                },
        ];

     
      
    } 

    

   


}
