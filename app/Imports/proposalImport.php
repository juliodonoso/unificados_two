<?php

namespace App\Imports;

// use App\proposal;
use App\Models\proposal;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\{Importable, ToModel, WithHeadingRow};


class proposalImport implements ToModel, WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */protected $dates = [];
    private $rows = 0;

    
    public function model(array $row)   
    

    {
        $Nro = session('nroexp');
        $Nmes = session('mes');
        $Nanio = session('anio');
        ++$this->rows;        
        return new proposal([                      
            'mov'=>$row['mov'] ?? null,  
            'poliza'=>$row['poliza']?? null,
            'numgru' => $row['numgru']?? null, 
            'ruttit' => $row['ruttit']?? null, 
            'dvtit'  => $row['dvtit'] ?? null,  
            'rutcar' => $row['rutcar']?? null,  
            'dvcar'  => $row['dvcar']?? null,  
            'pat'=> $row['pat']?? null, 
            'mat'=> $row['mat']?? null, 
            'nom'=> $row['nom']?? null, 
            'sex'=> $row['sex']?? null,    
            'fnac' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fnac'])),
            'isa'=> $row['isa']?? null, 
            'obs'=> $row['obs']?? null, 
            'email'=> $row['email']?? null, 
            'rel'=> $row['rel']?? null, 
            'dir'=> $row['dir']?? null, 
            'comunas'=> $row['comunas']?? null, 
            'ciudad'=> $row['ciudad']?? null, 
            'tper' => $row['tper']?? null, 
            'tben'=> $row['tben']?? null, 
            'pct'=> $row['pct']?? null,
            'vdesde' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['vdesde'])) ?? null,
            'vhasta'=> $row['vhasta']?? null, 
            'telf'=> $row['telf']?? null, 
            'monrta'=> $row['monrta']?? null, 
            'renta'=> $row['renta']?? null, 
            'propuesta'=> $row['propuesta']?? null, 
            'banco'=> $row['banco']?? null, 
            'nrocta'=> $row['nrocta']?? null, 
            'vigenciatc'=> $row['vigenciatc']?? null, 
            'diacob'=> $row['diacob']?? null, 
            'mescob'=> $row['mescob']?? null, 
            'rutter'=> $row['rutter']?? null, 
            'dvter'=> $row['dvter']?? null, 
            'nombreter'=> $row['nombreter']?? null, 
            'dirter'=> $row['dirter']?? null, 
            'ciudadter'=> $row['ciudadter']?? null, 
            'comunater'=> $row['comunater']?? null, 
            'telter'=> $row['telter']?? null, 
            'ppago'=> $row['ppago']?? null, 
            'pprepa'=> $row['pprepa']?? null, 
            'totaldep'=> $row['totaldep']?? null,  
            // 'fechadep' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fechadep'])) ?? null,
            'fechadep' => $row['fechadep']?? null,
            'fechavta' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fechavta'])) ?? null,           
            'rutsup'=> $row['rutsup']?? null, 
            'ejecutivo'=> $row['ejecutivo']?? null, 
            'llave'=> $row['llave']?? null, 
            'uf'=> $row['uf']?? null, 
            'peso'=> $row['peso']?? null, 
            'estat' => $row['estat']?? null, 
            'imc'=> $row['imc']?? null, 
            'supervisor'=> $row['supervisor']?? null, 
            'ejecutiva'=> $row['ejecutiva']?? null, 
            'fechaent' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fechaent'])) ?? null,        
            'clinica'=> $row['clinica']?? null, 
            'tipo'=> $row['tipo']?? null, 
            'origen'=> $row['origen']?? null,
            'clasif'=> $row['clasif']?? null, 
            'emp_id'=> $row['emp_id']?? null,
            'import_id' => $Nro,
            'mes' => $Nmes,
            'anio' => $Nanio,
            'observaciones' =>$row['observaciones']?? null,
            'gestion'=>$row['gestion'] ?? null,
            'tipificacion' =>$row['tipificacion'] ?? null,
            'subtipif' =>$row['subtipif'] ?? null,
            'gtcall' =>4 ?? null,
            'tpcall' =>$row['tpcall'] ?? null, 
            'borrado' => '0'    
        ]);
        
    }
    public static function beforeImport(BeforeImport $event)
{
    getRowCount();
}


public function getRowCount(): int
{
    return $this->rows;
}
    
}
