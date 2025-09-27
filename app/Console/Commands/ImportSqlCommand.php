<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImportSqlCommand extends Command
{
    /**
     * Tên và chữ ký của lệnh.
     */
    protected $signature = 'db:import-sql';

    /**
     * Mô tả của lệnh.
     */
    protected $description = 'Import a .sql file into the database';

    /**
     * Thực thi lệnh.
     */
    public function handle()
    {
        $path = database_path('backup.sql'); // Đường dẫn tới file sql trong thư mục database

        if (!File::exists($path)) {
            $this->error('File backup.sql not found in database directory.');
            return 1;
        }

        DB::unprepared(File::get($path));

        $this->info('Database imported successfully from backup.sql!');
        return 0;
    }
}