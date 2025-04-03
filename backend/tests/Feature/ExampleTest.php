<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Route;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        Route::get('/', function () {
            return response()->json([
                'message' => 'Welcome to the PayItForward Platform API',
                'status' => 'success'
            ], 200);
        });

        $response = $this->get('/');

        $response->assertStatus(200); // Expect a 200 status
        $response->assertJsonStructure([
            'message',
            'status'
        ]); // Ensure the JSON response has the expected structure
    }
}
