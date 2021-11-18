<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class SponsorExport implements FromCollection, WithHeadings, WithStyles,ShouldAutoSize,WithEvents,WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */

    function __construct($sponsor) {
      
        $this->sponsor = $sponsor;                         
    }

    public function collection()
    {
        //
        return $this->sponsor; 
    }

    public function headings(): array

    {
        return [ 
             'Sponsor','Canal','Campaña','alertas','Cumple','%Parcial','%Final','Total','Cumpl'
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
                    ->getDelegate()->getStyle('A1:I1')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('f2f6f7');
                },
        ];

    }

}
