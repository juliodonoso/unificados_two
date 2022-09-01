<?php

namespace App\Exports;

use App\campania;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;

class c1Export implements FromCollection,WithStrictNullComparison, WithHeadings, WithStyles,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */


    function __construct($datos) {

        $this->datos = $datos;
 }

 public function collection()
 {
     // return campania::all();
     return $this->datos;
 }

    public function headings(): array

    {
        return [
            'id','fecha','Rut','Apellido','contacto','mail','fono','poliza',
            'compania',
            'ramo',
            'inicio vigencia',
            'fin vigencia',
            'moneda',
            'prima afecta',
            'Prima neta',
            '% comision',
            'Comision',
            'Ejec Comercial',
            'Ejec gallagher',
            'Fecha Carga',
            'Fecha Gestion',
            'Gtid',
            'Contratacion',
            'recep Poliza',
            'infor',
            'encuesta',
            'Escala',
            'Observaciones',
            'consulta',
            'GestionID',
            '',
            'Gestion'
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
                ->getDelegate()->getStyle('A1:AD1')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f2f6f7');
            },
        ];

    }

}
