<?php

namespace App\Exports;

use App\Models\GeneratedQrCode;
use Illuminate\Support\Collection;
use App\Models\EquipmentInspection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class RegisteredEquipmentExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data;

    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function ($item) {
            // Add a custom column with static data
            $inspection = EquipmentInspection::where('inspection_equipment_qr_id', $item['equipment_qr_id'])
            ->latest('created_at')
            ->first(); 
            
            // Check if inspection record exists
            if ($inspection) {
            $item['Last Maintenance Date'] = $inspection->created_at;
            } else {
            $item['Last Maintenance Date'] = 'No Maintenance Recorded';
            }

            // Add a static value for "Client" column
            $item['Client'] = 'client';

                return $item;
        });
    }

    public function headings(): array
    {
        return [
            'Id',
            'Certified Provider Name',
            'Certification ID',           
            'Equipment QR Number',
            'Equipment Serial Number',
            'Application Date',            
            'Latitude',
            'Longitude',    
            'Last Maintenance Date',
            'Client',
        
        ];
    }
}
