<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->paragraph(),
            'deadline' => fake()->dateTimeBetween($startDate = '+1 years', $endDate = '+2 years', $timezone = 'Africa/Cairo'),
            'user_id' => User::pluck('id')->random(),
            'client_id' => Client::pluck('id')->random(),
        ];
    }
}
