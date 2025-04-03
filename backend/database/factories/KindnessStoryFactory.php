<?php

namespace Database\Factories;

use App\Models\KindnessStory;
namespace Database\Factories;

use App\Models\KindnessStory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KindnessStory>
 */
class KindnessStoryFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = KindnessStory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence,
            'story' => $this->faker->paragraph,
            'image' => null, // Start with no image
            'status' => 'approved', // Start with approved status for testing
        ];
    }
}
