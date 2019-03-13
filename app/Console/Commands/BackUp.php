<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class BackUp extends Command
{
    const MAX_GENERATION = 100;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:db_public';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup DB and public folder';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $ds = DIRECTORY_SEPARATOR;
        $backup_path = storage_path('backup');
        $backup_date = date('Ymd');
        $backup_time = date('His');
        $tmp_dir = $backup_path.$ds.'tmp';
        $tmp_backup_dir = $backup_date.$backup_time;
        $tmp_path = $tmp_dir.$ds.$tmp_backup_dir;
        $generations_path = $backup_path.$ds.'generations';
        $sqldump_file = 'sqldump.sql';

        Storage::disk('local_backup')->makeDirectory('tmp'.$ds.$tmp_backup_dir);
        Storage::disk('local_backup')->makeDirectory('generations');

        // Backup DB
        $command = "mysqldump ".env('DB_DATABASE')." --host=".env('DB_HOST', 'localhost')." --user=".env('DB_USERNAME')." --password=".env('DB_PASSWORD')." > ".$tmp_path.$ds.$sqldump_file;
        exec($command);

        // Backup public directory
        $directories = Storage::disk('local')->directories('public');
        foreach ($directories as $directory) {
            \File::copyDirectory(storage_path('app').$ds.$directory, $tmp_path.$ds.$directory);
        }

        // tar files
        if (Storage::disk('local_backup')->exists('generations'.$ds.$backup_date.'.tar.gz')) {
            $backup_date .= '_'.$backup_time;
        }
        $command = "tar -zcf ".$generations_path.$ds.$backup_date.".tar.gz -C ".$tmp_dir." ".$tmp_backup_dir;
        exec($command);

        // Manage max generation
        $files = Storage::disk('local_backup')->files('generations');
        if (count($files) > self::MAX_GENERATION) {
            $oldest = reset($files);
            Storage::disk('local_backup')->delete($oldest);
        }

        // Delete temporary directory
        Storage::disk('local_backup')->deleteDirectory('tmp');

        // Sync Google Drive
        $command = "/usr/local/bin/gdrive sync upload --keep-largest ".$generations_path." 10dDFLBg9MntIo4tamD1LX0KV9lQlIP7e";
        $ret = [];
        exec($command, $ret);

    }


}
