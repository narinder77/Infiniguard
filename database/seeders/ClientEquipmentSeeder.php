<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClientEquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $clientsDataJson =File::get(database_path('seeds/clients_data.json'));
        $clientsData = json_decode($clientsDataJson, true);
        $clientsDataRows = array_filter($clientsData, function ($item) {
            return isset($item['type']) && $item['type'] === 'table' && isset($item['data']);
        });
        if (count($clientsDataRows) === 0) {
            $this->command->info('No data found in JSON file.');
            return;
        }
        $dataArray = reset($clientsDataRows)['data'];

        $clientsEquipmentsJson = File::get(database_path('seeds/clients_equipments.json'));
        $clientsEquipments = json_decode($clientsEquipmentsJson, true);

        $clientsEquipmentsdataRows = array_filter($clientsEquipments, function ($item) {
            return isset($item['type']) && $item['type'] === 'table' && isset($item['data']);
        });
        if (count($clientsEquipmentsdataRows) === 0) {
            $this->command->info('No data found in JSON file.');
            return;
        }
        $dataArray2 = reset($clientsEquipmentsdataRows)['data'];

        // Group JSON data by 'qr_id'
        $groupedData = [];
        foreach ($dataArray as $item) {
            $groupedData[$item['qr_id']][] = $item;
        }

        foreach ($groupedData as $qrId => $group) {
            // Initialize extra client data array
            $extraclientData = [];

            // Iterate over group to gather additional data
            foreach ($group as $item) {
                          
                $extraData = [
                    'ContactName' => $item['ContactName'],
                    'Email' => $item['Email'],
                    'Added_from' => $item['added_from'],
                ];

                // Push extra data into $extraclientData array
                $extraclientData[] = $extraData;
            }         

            // Assuming you take the first item's created_at and updated_at for the whole group
            $created_at = $group[0]['created_at'];
            $updated_at = $group[0]['updated_at'];

            // Insert data into the new table client_equipments for each group
            $clientEquipmentData = [];
            foreach ($group as $item) {
                $equipmentData = array_filter($dataArray2, function ($equipment) use ($item) {
                    return $equipment['qr_id'] == $item['qr_id'];
                });  
                // if($item['qr_id'] == 11372){
                //     dd($equipmentData,$equipmentData['client_id']);
                // }
                $clientEquipmentData= [
                    'client_equipment_id' => $item['id'], // Assuming client_data id is used as the primary key
                    'equipment_qr_id' => $item['qr_id'],
                    'client_id' => $equipmentData['client_id'] ?? null,
                    'client_maintenance_reminder' => !empty($equipmentData) && !empty($equipmentData['Maintenance_Reminder']) ? $equipmentData['Maintenance_Reminder'] : 1,
                    'client_reminder_days' => !empty($equipmentData) && !empty($equipmentData['Reminder_days']) ? $equipmentData['Reminder_days'] : 90 ,
                    'client_reminder_language' => ($item['Lang'] == '0' ? '1' : '2'),
                    'client_additional_info' => json_encode($extraclientData),
                    'created_at' => $created_at,
                    'updated_at' => $updated_at,
                ];
            }       
            // Insert data into the new table client_equipments
            DB::table('client_equipments')->insert($clientEquipmentData);
        }

    
        // Restore original SQL mode
       
    }
}
