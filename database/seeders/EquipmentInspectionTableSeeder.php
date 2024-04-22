<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EquipmentInspection;
use Illuminate\Support\Facades\File;
class EquipmentInspectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function convertToDateOnlyFormat($date)
    {
        // Define regular expressions for different date formats
        $regexFormats = [
            '/(\d{2}-\d{2}-\d{4}) (\d{2}:\d{2})/',     // Day-month-year hour:minute
            '/(\d{4}-\d{2}-\d{2}) (\d{2}:\d{2}:\d{2})/', // Year-month-day hour:minute:second
            '/(\d{4}-\d{2}-\d{2}) : (\d{2}:\d{2}:\d{2})/', // Year-month-day : hour:minute:second
            '/(\d{2}-\d{2}-\d{4})/',                  // Day-month-year
            '/(\d{4}-\d{2}-\d{2}) : (\d{2}:\d{2})/',    // Year-month-day : hour:minute
            '/(\d{2}-\d{2}-\d{4})/',                  // Month-day-year
        ];
        // Define replacements for each format
        $replacements = [
            '$4-$3-$2 $5',   // Day-month-year hour:minute
            '$1 $2',         // Year-month-day hour:minute:second
            '$1 $2',         // Year-month-day : hour:minute:second
            '$3-$2-$1',      // Day-month-year
            '$1 $2',         // Year-month-day : hour:minute
            '$3-$1-$2',      // Month-day-year
        ];
        $dates = [
            'date' => $date
        ];
        foreach ($dates as $date) {
            foreach ($regexFormats as $index => $regex) {
                if (preg_match($regex, $date)) {
                    $formattedDate = preg_replace($regex, $replacements[$index], $date);
                    $parsedDate = date('Y-m-d H:i:s', strtotime($formattedDate));
                    if ($parsedDate != '1970-01-01 00:00:00') {
                        return $parsedDate;
                    }
                }
            }
        }
        return $date;
    }

    public function convertDate($dateString)
    {
        $timestamp = strtotime($dateString);
        return date("Y-m-d H:i:s", $timestamp);
    }
    public function run(): void
    {
        $json = File::get(database_path('seeds/inspection.json'));
        $data = json_decode($json, true);
        $dataArray = [];

        foreach ($data[2]['data'] as $item) {
            if (empty($item['condenser_coil_image1']) && empty($item['condenser_coil_image2'])) {
                $item['condenser_image'] = null;
            } else {
                $item['condenser_image'] =  json_encode([$item['condenser_coil_image1'], $item['condenser_coil_image2']]);
            }
            if (empty($item['cabinet_image1']) && empty($item['cabinet_image2'])) {
                $item['cabinet_image'] = null;
            } else {
                $item['cabinet_image'] =  json_encode([$item['cabinet_image1'], $item['cabinet_image2']]);
            }
            if (empty($item['evaporator_image1']) && empty($item['evaporator_image2'])) {
                $item['evaporator_image'] = null;
            } else {
                $item['evaporator_image'] =  json_encode([$item['evaporator_image1'], $item['evaporator_image2']]);
            }
            if (empty($item['additionalImage1']) && empty($item['additionalImage1'])) {
                $item['additional_image'] = null;
            } else {
                $item['additional_image'] =  json_encode([$item['additionalImage1'], $item['additionalImage2']]);
            }
            $inspectionData = [
                'inspection_id' => $item['id'],
                'inspection_equipment_qr_id' => $item['qr_id'],
                'inspection_condenser_image' => $item['condenser_image'],
                'inspection_cabinet_image' => $item['cabinet_image'],
                'inspection_evaporator_image' => $item['evaporator_image'],
                'inspection_additional_image' => $item['additional_image'],
                'inspection_address' => $item['address'],
                'inspection_notes' => $item['notes'],
                'inspection_latitude' => $item['lat'],
                'inspection_longitude' => $item['lng'],
                'inspection_reminder_date' => $this->convertToDateOnlyFormat($this->convertDate($item['inspection_reminder_date'])),
                'created_at' => $this->convertToDateOnlyFormat($this->convertDate($item['created_date'])),
                'updated_at' => $this->convertToDateOnlyFormat($this->convertDate($item['created_date']))
            ];

            $dataArray[] = $inspectionData;
        }
        $chunks = array_chunk($dataArray,1000);
        foreach($chunks as $chunk){
            EquipmentInspection::insert($chunk);
        }


    }
}
