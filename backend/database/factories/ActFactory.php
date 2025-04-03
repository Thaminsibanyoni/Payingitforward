<?php

namespace Database\Factories;

use App\Models\Act;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActFactory extends Factory
{
    protected $model = Act::class;

    public function definition()
    {
        return [
            'giver_id' => User::factory(),
            'receiver_id' => User::factory(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => 'pending',
        ];
    }
}
