<?php

namespace Modules\Parcel\Console\Commands;

use Illuminate\Console\Command;

class ParcelCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ParcelCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parcel Command description';

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
