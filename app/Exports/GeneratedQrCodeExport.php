<?php

namespace App\Exports;

use App\Models\GeneratedQrCode;
use Maatwebsite\Excel\Concerns\FromCollection;

class GeneratedQrCodeExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return GeneratedQrCode::all();
    }
}
