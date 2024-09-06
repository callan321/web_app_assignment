<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class Database extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // files names
        $dbPath = database_path('database.sqlite');
        $sqlFile = database_path('database.sql');

        // del db if exists
        if (File::exists($dbPath)) {
            File::delete($dbPath);
            $this->info("Existing database.sqlite file deleted.");
        }

        // init new db
        File::put($dbPath, '');
        $this->info("New database.sqlite file created.");

        // migrate and seed with database.sql
        try {
            $sql = File::get($sqlFile);
            DB::unprepared($sql);
            $this->info('Database refreshed, tables recreated, and data seeded successfully!');
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }
    }

}
