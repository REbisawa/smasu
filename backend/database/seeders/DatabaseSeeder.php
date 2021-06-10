<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            // EventTableSeeder::class
            // UserSeeder::class
        ]);
        // for($i = 1; $i < 10; $i++){
        //     $user = User::find($i);
        //     $user->admins()->attach(1);
        // }
    }
}
