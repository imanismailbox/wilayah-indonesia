<?php

namespace Badak\Indonesia\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'badak:indonesia:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed database';

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
        Artisan::call('db:seed', ['--class' => 'Badak\Indonesia\Seeds\DatabaseSeeder', '--force' => true]);
        $this->info('Seeded: Badak\Indonesia\Seeds\IndonesiaSeeder');
    }
}
