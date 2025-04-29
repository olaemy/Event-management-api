<?php

namespace Database\Factories;

use App\Models\Attendee;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class AttendeeFactory extends Factory
{
    protected $model = Attendee::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_id' => Event::inRandomOrder()->first()->id ?? Event::factory(),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
        ];
    }
}
