<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearTextFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'files:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear Temporary Text Files';

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
        $files = glob(public_path() . '/tmp/*.txt');
        foreach($files as $file){
            if(is_file($file))
            unlink($file);
        }
    }
}
