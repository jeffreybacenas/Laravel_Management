<?php

namespace App\Services;

use App\Models\SystemLogs;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportExcel implements FromCollection
{
    public function collection()
    {
        return SystemLogs::all();
    }
}