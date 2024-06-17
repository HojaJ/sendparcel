<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Car\Models\Car;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 't:t';

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
        $car = Car::first();
        dd($car->remain);
    }
}
