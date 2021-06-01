<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    // use Carbon\Carbon;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //データ挿入
            'title' => $this->faker->word,
            'text' => $this->faker->text(100),
            'user_id' => 1,
            'scheduled_for' => $this->faker->dateTimeBetween('-1 week', '+1 week')->format('Y-m-d'),

        ];
    }
}
