<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmailDistributionListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $emailAddresses = [
            'admin@infiniguard.com',
            'jose@infiniguard.com',
            'developer@infiniguard.com',
            'arjun@technoarray.com',
            'codecoretesting@gmail.com',
        ];

        DB::table('email_distribution_lists')->insert([
            'email_addresses' => json_encode($emailAddresses),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
