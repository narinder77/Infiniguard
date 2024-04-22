<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RegisteredQrCode;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RegisteredQRCodesTableSeeder extends Seeder
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
        $json = File::get(database_path('seeds/qr_details.json'));
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
                'id' =>  $item['id'],
                'equipment_qr_id' =>  $item['qr_id'],
                'applicator_id' => $item['seller_id'],
                'condenser' =>$item['condenser_coil']== 'yes' ? '1' : '0',
                'cabinet' => $item['cabinet']== 'yes' ? '1' : '0',
                'evaporator' => $item['evaporator_coil']== 'yes' ? '1' : '0',
                'model_number_image' => $item['model_number_image'],
                'serial_number_image' =>$item['additional_image'],
                'equipment_type' => $item['equipment_type'],
                'notes' => $item['notes'],
                'address' => $item['address'],
                'latitude' => $item['lat'],
                'longitude' => $item['lng'],
                'created_at' => $this->convertToDateOnlyFormat($this->convertDate($item['created_date'])),
                'updated_at' => $this->convertToDateOnlyFormat($this->convertDate($item['modify_date'])),
            ];
        }
        $chunks = array_chunk($insertData, 1000);
        foreach ($chunks as $chunk) {
            RegisteredQrCode::insert($chunk);
        }
    }
}
