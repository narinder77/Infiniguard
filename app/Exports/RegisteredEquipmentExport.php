<?php

namespace App\Exports;

use App\Models\GeneratedQrCode;
use App\Models\RegisteredQrCode;
use Maatwebsite\Excel\Concerns\FromCollection;

class RegisteredEquipmentExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data=RegisteredQrCode::all();    
        return $data;
    }
}
