<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocationTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_locations(): void
    {
        Location::factory()->count(3)->create();

        $response = $this->getJson('/api/locations');

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_can_create_location(): void
    {
        $payload = [
            // no payload
        ];

        $response = $this->postJson('/api/locations', $payload);

        $response->assertCreated();
        $this->assertDatabaseHas('locations', [
            // 
        ]);
    }

    public function test_can_show_location(): void
    {
        $model = Location::factory()->create();

        $response = $this->getJson("/api/locations/{$model->getKey()}");

        $response->assertOk()
            ->assertJsonFragment(['id' => $model->getKey()]);
    }

    public function test_can_update_location(): void
    {
        $model = Location::factory()->create();

        $payload = [
            // no payload
        ];

        $response = $this->putJson("/api/locations/{$model->getKey()}", $payload);

        $response->assertOk();
    }

    public function test_can_delete_location(): void
    {
        $model = Location::factory()->create();

        $response = $this->deleteJson("/api/locations/{$model->getKey()}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('locations', ['id' => $model->getKey()]);
    }
}
