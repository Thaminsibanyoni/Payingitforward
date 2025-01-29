<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Act;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create test users
        $user1 = User::factory()->create([
            'name' => 'Test User 1',
            'email' => 'user1@test.com',
        ]);

        $user2 = User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'user2@test.com',
        ]);

        // Create test acts
        Act::factory()->create([
            'giver_id' => $user1->id,
            'receiver_id' => $user2->id,
            'title' => 'Help with groceries',
            'description' => 'I can help carry groceries to your car',
            'status' => 'pending'
        ]);

        Act::factory()->create([
            'giver_id' => $user2->id,
            'receiver_id' => $user1->id,
            'title' => 'Teach guitar lesson',
            'description' => 'I can teach you basic guitar chords',
            'status' => 'pending'
        ]);
    }
}
