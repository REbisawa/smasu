<?php

namespace Database\Factories;

use App\Models\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class ScheduleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Schedule::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
         $start_time = new Carbon($this->faker->time('H:i'));
         $end_time = $start_time->copy()->addHours(8);

        return [
            'user_id' => $this->faker->biasedNumberBetween($min = 1, $max = 10, $function = 'sqrt'),
            'scheduled_for' => $this->faker->unique->dateTimeBetween('-1 week', '+1 week')->format('Y-m-d'),
            'start' => $start_time,
            'end' => $end_time,
            'memo' => $this->faker->sentence,
        ];
    }
}
