<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (User::count()) {
            $this->command->info('Truncate users table');
            User::truncate();
        }

        // generate fake user data
        User::factory(10)->create();
    }

}
