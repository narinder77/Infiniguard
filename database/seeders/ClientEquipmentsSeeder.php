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
       // Disable ONLY_FULL_GROUP_BY mode temporarily
            DB::statement("SET sql_mode = ''");

            // Retrieve data from the old table
            $oldclientData = DB::table('clients_data')->groupBy('qr_id')->get();

            // Restore original SQL mode
     
        foreach ($oldclientData as $clientData) {
            
            // Retrieve additional data from clients_data table based on qr_id
            $extraInfo = DB::table('clients_data')->where('qr_id', $clientData->qr_id)->get();
            $extraclientData = array(); // Initialize the array

            foreach ($extraInfo as $data) {
                $extraData = array(); // Initialize the $extraData array for each iteration
            
                // Populate $extraData array with data from $data
                $extraData['ContactName'] = $data->ContactName;
                $extraData['Email'] = $data->Email;
                $extraData['Reminder_days'] = $data->Reminder_days;
                $extraData['Lang'] = $data->Lang;
            
                // Push $extraData into $extraclientData array
                $extraclientData[] = $extraData;
            }
           
            // Retrieve old client equipment
            $oldClientEquipment = DB::table('clients_equipments')->where('qr_id', $clientData->qr_id)->first();

            // Transform data and store extra info in client_additional_info column in JSON format
            $data = [
                'equipment_qr_id' => $oldClientEquipment ? $oldClientEquipment->qr_id : $clientData->qr_id,
                'client_id' => $oldClientEquipment ? $oldClientEquipment->client_id : null,
                'client_maintenance_reminder' => $oldClientEquipment ? $oldClientEquipment->Maintenance_Reminder : 1,
                'client_reminder_days' => $oldClientEquipment ? $oldClientEquipment->Reminder_days : 90,
                'client_reminder_language' => $oldClientEquipment ? ($oldClientEquipment->Reminder_language == 'English' ? '1' : '2') : 1,
                'created_at' => $oldClientEquipment ? $oldClientEquipment->created_at : $clientData->created_at,
                'updated_at' => $oldClientEquipment ? $oldClientEquipment->updated_at : $clientData->updated_at,
                'client_additional_info' => json_encode($extraclientData),
            ];

            // Insert data into the new table
            DB::table('client_equipments')->insert($data);
            DB::statement("SET sql_mode = 'ONLY_FULL_GROUP_BY'");

        }
    }
}
