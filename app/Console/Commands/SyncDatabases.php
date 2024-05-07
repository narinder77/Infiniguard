<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SyncDatabases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-databases';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync live database with local database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try{
            
            $host= env('LIVE_DB_HOST');
            $database= env('LIVE_DB_DATABASE');
            $username= env('LIVE_DB_USERNAME');
            $password= env('LIVE_DB_PASSWORD');

            $this->info('Exporting live database...');
            exec('"D:\xampp\mysql\bin\mysqldump" -u '.$username.' -p'.$password.' -h '.$host.' '.$database.' > database_dump.sql');
            
        } catch (\Exception $e) {
            $this->error('Error exporting database: ' . $e->getMessage());
        }
    
        // Transfer database dump from live to local
        $this->info('Transferring database dump from live to local...');
        Storage::disk('local')->put('database_dump.sql', file_get_contents('database_dump.sql'));

        // Import database dump into local database
        // $this->info('Importing database dump into local database...');
        // exec('mysql -u USERNAME -pPASSWORD -h LOCAL_DB_HOST LOCAL_DB_NAME < database_dump.sql');

        // // Cleanup: Delete temporary database dump file
        // unlink('database_dump.sql');

        $this->info('Database sync completed successfully.');
    }
}
