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
        $json = File::get(database_path('seeds/clients.json'));
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
                'client_id' => $item['id'],
                'client_provider_id' => $item['company_id'],
                'client_company_name' => $item['company_name'],
                'client_firstname' => $item['Client_firstname'],
                'client_lastname' => $item['Client_lastname'],
                'client_email' => $item['Client_email'],
                'client_phone' => $item['Client_phone'],
                'client_password' => $item['password'],
                'client_status' => $item['status'],
                'client_otp' => $item['confirm_code'],
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
