<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CertifiedProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class CertifiedProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
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
            '/(\d{2}\/\d{2}\/\d{4})/', 
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
            '$1',             // Month/day/year
        ];

        $dates = [
            'date' => $date,
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

        $json = File::get(database_path('seeds/company.json'));
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
                'provider_id' => $item['id'],
                'provider_type' => $item['type'] == 'admin' ? '1' : '2',
                'provider_administrator' => $item['company_administrator'],
                'provider_name' => $item['company_name'],
                'provider_logo_image' => $item['company_logo'],
                'provider_profile_image' => $item['profile_image'],
                'provider_email' => $item['company_email'],
                'provider_phone' => $item['company_phone'],
                'provider_password' =>$item['company_password'],
                'provider_status' => $item['status'],
                'created_at' => $this->convertToDateOnlyFormat($item['created_date']),
                'updated_at' => $this->convertToDateOnlyFormat($item['modify_date'])
            ];
        }

        $insertData[] = [
            'provider_id' =>'76',
            'provider_type' => 1,
            'provider_administrator' => 'Administrator',
            'provider_name' => 'Administrator Company',
            'provider_logo_image' => 'company_logo',
            'provider_profile_image' => 'profile_image',
            'provider_email' => 'infiniguard@example.com',
            'provider_phone' => '123456789',
            'provider_password' =>Hash::make('password'),
            'provider_status' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $chunks = array_chunk($insertData, 1000);
        foreach ($chunks as $chunk) {
            CertifiedProvider::insert($chunk);
        }
    }
}
