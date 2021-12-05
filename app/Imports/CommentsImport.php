<?php

namespace App\Imports;

use App\Models\Audit;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class CommentsImport implements ToModel, WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $guarded = [];
    private $rows = 0;

    public function model(array $row)
    {
        return new Audit([
            'Apelacion' => $row['Apelacion'] ?? null,
            'CommentsCall' => $row['ComentCallCenter'] ?? null,                  
            'AuditorCall' => $row['AuditorCallCenter'] ?? null,
            'ResolucionBECS' => $row['ResolBECS'] ?? null,
            'AccionesBECS' => $row['AccionesBECS'] ?? null,
            'CommentsCIA' => $row['ComentCia'] ?? null,
        ]);
    }
}
