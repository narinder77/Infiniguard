<?php

namespace Database\Seeders;

use App\Models\ClientEquipment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ClientEquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('seeds/clients_data.json'));
        $data = json_decode($json, true);

        $dataRows = array_filter($data, function ($item) {
            return isset($item['type']) && $item['type'] === 'table' && isset($item['data']);
        });

        if (count($dataRows) === 0) {
            $this->command->info('No data found in JSON file.');
            return;
        }

        $dataArray = reset($dataRows)['data'];



        $groupedData = [];
        foreach ($dataArray as $item) {
            $qrId = $item['qr_id'];
            if (!isset($groupedData[$qrId])) {
                $groupedData[$qrId] = [
                    'client_equipment_id' => $item['id'],
                    'equipment_qr_id' => $item['qr_id'],
                    'client_id' => $item['client_id'] ?? null,
                    'client_maintenance_reminder' => 1,
                    'client_reminder_days' => $item['Reminder_days'],
                    'client_reminder_language' => $item['Lang'],
                    'client_additional_info' => [],
                    'created_at' => $item['created_at'],
                    'updated_at' => $item['updated_at'],
                ];
            }
            if (!empty($item['ContactName']) || !empty($item['Email'])) {
                $groupedData[$qrId]['client_additional_info'][] = ['ContactName' => $item['ContactName'], 'Email' => $item['Email']];
            }
        }

        // Convert additional info to JSON
        foreach ($groupedData as &$item) {
            $item['client_additional_info'] = json_encode($item['client_additional_info']);
        }

        // Insert data into the database
        $chunks = array_chunk($groupedData, 1000);
        foreach ($chunks as $chunk) {
            ClientEquipment::insert($chunk);
        }
    }
}