<?php

namespace Database\Seeders;

use App\Models\GeneratedQrCode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class GeneratedQRCodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('seeds/qr.json'));
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
            $insertData[] = [
                'equipment_qr_id' => $item['id'],
                'equipment_qr_number' => $item['qr_number'],
                'equipment_model_number' => $item['model_no'],
                'equipment_serial_number' => $item['serial_no'],
                'created_at' => $item['created_at'],
                'updated_at' => $item['created_at']
            ];
        }
        $chunks = array_chunk($insertData, 5000);
        foreach ($chunks as $chunk) {
            GeneratedQrCode::insert($chunk);
        }
    }
}
