<?php

namespace App\Exports;
use App\Models\Reclamation;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReclamationsExport implements FromCollection
{
    public function collection()
    {
        return Reclamation::all();
    }
}
