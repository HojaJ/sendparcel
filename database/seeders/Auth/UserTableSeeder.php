<?php

namespace Database\Seeders\Auth;

use App\Events\Backend\UserCreated;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

/**
 * Class UserTableSeeder.
 */
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $faker = \Faker\Factory::create();

        // Add the master administrator, user id of 1
        $users = [
            [
                'id' => 1,
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'email' => 'super@admin.com',
                'password' => Hash::make('password'),
                'mobile' => $faker->phoneNumber,
            ],
            [
                'id' => 2,
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'car@admin.com',
                'password' => Hash::make('password'),
                'mobile' => $faker->phoneNumber,
            ],
        ];

        foreach ($users as $user_data) {
            $user = User::create($user_data);
        }

        Schema::enableForeignKeyConstraints();
    }
}
