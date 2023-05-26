<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
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
            'project_id' => Project::pluck('id')->random(),
            'description' => fake()->paragraph(),
            'deadline' => fake()->dateTimeBetween($startDate = '+1 years', $endDate = '+2 years', $timezone = 'Africa/Cairo'),
            'completed_at' => fake()->dateTimeBetween($startDate = '+1 years', $endDate = '+2 years', $timezone = 'Africa/Cairo'),
            'user_id' => User::pluck('id')->random(),
        ];
    }
}
