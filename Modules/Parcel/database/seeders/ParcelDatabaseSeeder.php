<?php

namespace Modules\Parcel\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Tag\Models\Parcel;

class ParcelDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        /*
         * Parcels Seed
         * ------------------
         */

        // DB::table('parcels')->truncate();
        // echo "Truncate: parcels \n";

        Parcel::factory()->count(20)->create();
        $rows = Parcel::all();
        echo " Insert: parcels \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
