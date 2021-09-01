<?php

namespace App\Imports;

use App\Proposal;

use Maatwebsite\Excel\Concerns\{Importable, ToModel, WithHeadingRow};

class UpdateImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Proposal([
            //
            'rutcar'=>$row['rutcar'] ?? null,
            'gestion'=>$row['gestion'] ?? null,  
            'tipificacion'=>$row['tipificacion']?? null,
            'Observaciones'=>$row['obs']?? null,            
        ]);
    }
}
