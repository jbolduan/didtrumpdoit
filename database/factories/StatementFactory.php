<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StatementFactory extends Factory
{

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'status_id' => $this->faker->numberBetween(1, 5),
            'status_details' => $this->faker->paragraph(),
            'user_id' => $this->faker->numberBetween(1, 5),
            'is_public' => $this->faker->boolean()
        ];
    }
}
