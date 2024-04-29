<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('seeds/clients_data.json'));
        $data = json_decode($json, true);

        $groupedData = collect($data)->groupBy(function ($item) {
            // Assuming 'client_id' is the key within the JSON data you want to group by
            return $item['client_id'];
        });
        dd($groupedData);
        foreach ($groupedData as $clientId => $items) {
            $insertData = [];
            foreach ($items as $item) {
                $insertData[] = [
                    'client_equipment_id' => $item['id'],
                    'equipment_qr_id' => $item['qr_id'],
                    'client_id' => $item['company_name'],
                    'client_maintenance_reminder' => $item['Client_firstname'],
                    'client_reminder_days' => $item['Client_lastname'],
                    'client_reminder_language' => $item['Client_email'],
                    'client_additional_info' => $item['Client_phone'],
                    'created_at' => $item['created_at'],
                    'updated_at' => $item['updated_at'],
                ];
            }
            $chunks = array_chunk($insertData, 1000);
            foreach ($chunks as $chunk) {
                Client::insert($chunk);
            }
        }
    }
}
