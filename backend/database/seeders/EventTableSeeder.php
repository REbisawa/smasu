<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Event::factory()->count(10)->create();
        // factory(Database\Factories\EventFactory::class, 10)->create();
    }
}
