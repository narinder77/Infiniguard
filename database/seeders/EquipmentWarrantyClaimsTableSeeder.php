<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EquipmentWarrantyClaim;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EquipmentWarrantyClaimsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function convertToDateOnlyFormat($date)
    {
        // Define regular expressions for different date formats
        $regexFormats = [
            '/(\d{2}-\d{2}-\d{4}) (\d{2}:\d{2})/',            // Day-month-year hour:minute
            '/(\d{4}-\d{2}-\d{2}) (\d{2}:\d{2}:\d{2})/',      // Year-month-day hour:minute:second
            '/(\d{4}-\d{2}-\d{2}) : (\d{2}:\d{2}:\d{2})/',    // Year-month-day : hour:minute:second
            '/(\d{2}-\d{2}-\d{4})/',                          // Day-month-year
            '/(\d{4}-\d{2}-\d{2}) : (\d{2}:\d{2})/',          // Year-month-day : hour:minute
            '/(\d{2}-\d{2}-\d{4})/',                          // Month-day-year
            '/(\d{4}-\d{2}-\d{2}) (\d{2}:\d{2}) (AM|PM)/',    // Year-month-day hour:minute AM/PM
        ];

        // Define replacements for each format
        $replacements = [
            '$4-$3-$2 $5',    // Day-month-year hour:minute
            '$1 $2',          // Year-month-day hour:minute:second
            '$1 $2',          // Year-month-day : hour:minute:second
            '$3-$2-$1',       // Day-month-year
            '$1 $2',          // Year-month-day : hour:minute
            '$3-$1-$2',       // Month-day-year
            '$1 $2 $3',       // Year-month-day hour:minute AM/PM
        ];

        $dates = [
            'date' => '2024-04-23 04:41 PM',
        ];

        foreach ($dates as $date) {
            foreach ($regexFormats as $index => $regex) {
                if (preg_match($regex, $date)) {
                    $formattedDate = preg_replace($regexFormats, $replacements[$index], $date);
                    $parsedDate = date('Y-m-d H:i:s', strtotime($formattedDate));
                    if ($parsedDate != '1970-01-01 00:00:00') {
                        return $parsedDate;
                    }
                }
            }
        }
    }

    public function convertDate($dateString)
    {
        $timestamp = strtotime($dateString);
        return date("Y-m-d H:i:s", $timestamp);
    }
    public function run(): void
    {
        $json = File::get(database_path('seeds/warrenty_claim.json'));
        $data = json_decode($json, true);
        $dataRows = array_filter($data, function ($item) {
            return isset($item['type']) && $item['type'] === 'table' && isset($item['data']);
        });
        if (count($dataRows) === 0) {
            $this->command->info('No data found in JSON file.');
            return;
        }
        $dataArray = reset($dataRows)['data'];
        $insertData = [];
        foreach ($dataArray as &$item) {
            if (empty($item['additionalImage1']) && empty($item['additionalImage2'])) {
                $item['additional_image'] = null;
            } else {
                $item['additional_image'] =  json_encode([$item['additionalImage1'], $item['additionalImage2']]);
            }
            $insertData[] = [
                'equipment_claim_id' => $item['id'],
                'equipment_claim_status' => $item['status'] == 'answered' ? '1' : '0',
                'equipment_claim_name' => $item['name'],
                'equipment_claim_email' => $item['email'],
                'equipment_claim_phone_number' => $item['phone_number'],
                'equipment_claim_qr_id' => $item['qr_id'],
                'equipment_claim_inspection_id' => $item['inspection_id'],
                'equipment_claim_date' => $this->convertToDateOnlyFormat($this->convertDate($item['claim_date'])),
                'equipment_claim_notes' => $item['notes'],
                'equipment_claim_address' => $item['address'],
                'equipment_claim_latitude' => $item['lat'],
                'equipment_claim_longitude' => $item['lng'],
                'created_at' => $this->convertToDateOnlyFormat($this->convertDate($item['date'])),
                'updated_at' => $this->convertToDateOnlyFormat($this->convertDate($item['date']))
            ];
        }
        $chunks = array_chunk($insertData, 1000);
        foreach ($chunks as $chunk) {
            EquipmentWarrantyClaim::insert($chunk);
        }
    }
}
