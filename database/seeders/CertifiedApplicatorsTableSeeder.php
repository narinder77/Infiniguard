<?php

namespace Database\Seeders;

use DateTime;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\CertifiedApplicator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class CertifiedApplicatorsTableSeeder extends Seeder
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
        $json = File::get(database_path('seeds/certified_applicators.json'));
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
                'applicator_id' => $item['id'],
                'applicator_certification_id' => $item['certification_id'],
                'applicator_provider_id' => $item['company_id'],
                'applicator_name' => $item['name'],
                'applicator_email' => $item['email'],
                'applicator_password' => $item['password'],
                'applicator_date' => $this->convertDate($item['date']),
                'applicator_language' => $item['Lang'],
                'applicator_status' => $item['status'],
                'created_at' =>  $this->convertToDateOnlyFormat($item['created_date']),
                'updated_at' =>  $this->convertToDateOnlyFormat($item['modify_date']),
            ];
        }
        $chunks = array_chunk($insertData, 100);
        foreach ($chunks as $chunk) {
            CertifiedApplicator::insert($chunk);
        }
    }
}
