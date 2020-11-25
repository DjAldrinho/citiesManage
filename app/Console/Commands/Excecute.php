<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Excecute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'execute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ejecuta las migraciones y los seeds';

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
     * @return int
     */
    public function handle()
    {
        try {

            $this->call('migrate:fresh');
            $this->call('db:seed');
            return 'Migraciones ejecutadas correctamente';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
