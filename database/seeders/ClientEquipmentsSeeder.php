<?php

namespace Database\Seeders;

use App\Models\ClientEquipment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientEquipmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonData = file_get_contents(storage_path('app/seeds/your_json_file.json'));
        $data = json_decode($jsonData, true);
    
        // Group JSON data by 'qr_id'
        $groupedData = [];
        foreach ($data as $item) {
            $groupedData[$item['qr_id']][] = $item;
        }
    
        // Process each group
        foreach ($groupedData as $qrId => $group) {
            // Initialize extra client data array
            $extraclientData = [];
    
            // Iterate over group to gather additional data
            foreach ($group as $item) {
                // Populate extra data
                $extraData = [
                    'ContactName' => $item['ContactName'],
                    'Email' => $item['Email'],
                    'Reminder_days' => $item['Reminder_days'],
                    'Lang' => $item['Lang'],
                ];
    
                // Push extra data into $extraclientData array
                $extraclientData[] = $extraData;
            }
    
            // Assuming you take the first item's created_at and updated_at for the whole group
            $created_at = $group[0]['created_at'];
            $updated_at = $group[0]['updated_at'];
    
            // Insert data into the new table client_equipments for each group
            foreach ($group as $item) {
                $clientEquipmentData = [
                    'client_equipment_id' => $item['id'], // Assuming client_data id is used as the primary key
                    'equipment_qr_id' => $item['qr_id'],
                    'client_id' => $item['client_id'],
                    'client_maintenance_reminder' => $item['Maintenance_Reminder'],
                    'client_reminder_days' => $item['Reminder_days'],
                    'client_reminder_language' => ($item['Reminder_language'] == 'English' ? '1' : '2'),
                    'client_additional_info' => json_encode($extraclientData),
                    'created_at' => $created_at,
                    'updated_at' => $updated_at,
                ];
    
                // Insert data into the new table client_equipments
                DB::table('client_equipments')->insert($clientEquipmentData);
            }
        }
    
        // Restore original SQL mode
       
    }
    
}
