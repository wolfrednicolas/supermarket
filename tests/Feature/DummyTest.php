<?php declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DummyTest extends TestCase
{
   use RefreshDatabase;
    /**
     * Dummy api test endpoint
     */
    public function test_dummy_endpoint_works_without_session(): void
    {
        $response = $this->getJson('/api/test');

        $response->assertStatus(200);
    }

    /**
     * Dummy endpoint using sanctum, cannot be accesed without token
     */
    public function test_dummy_endpoint_cannot_be_accesed_without_token(): void
    {
        $response = $this->getJson('/api/userTest');

        $response->assertStatus(401);
    }

    /**
     * Dummy endpoint using sanctum, can be accesed with token
     */
    public function test_dummy_endpoint_can_be_accesed_with_token(): void
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->getJson('/api/userTest');

        $response->assertStatus(200);
    }
    
}
