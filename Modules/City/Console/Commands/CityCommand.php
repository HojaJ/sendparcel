<?php

namespace Modules\City\Console\Commands;

use Illuminate\Console\Command;

class CityCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:CityCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'City Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
