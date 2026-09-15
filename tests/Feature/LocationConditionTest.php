<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\LocationCondition;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocationConditionTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_location_conditions(): void
    {
        LocationCondition::factory()->count(3)->create();

        $response = $this->getJson('/api/location_conditions');

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_can_create_location_condition(): void
    {
        $payload = [
            'location_id' => fake()->randomNumber(),
            'condition_of_ppe' => fake()->word(),
            'remarks' => fake()->paragraph(),
        ];

        $response = $this->postJson('/api/location_conditions', $payload);

        $response->assertCreated();
        $this->assertDatabaseHas('location_conditions', [
            'location_id' => $payload['location_id'],
        ]);
    }

    public function test_can_show_location_condition(): void
    {
        $model = LocationCondition::factory()->create();

        $response = $this->getJson("/api/location_conditions/{$model->getKey()}");

        $response->assertOk()
            ->assertJsonFragment(['id' => $model->getKey()]);
    }

    public function test_can_update_location_condition(): void
    {
        $model = LocationCondition::factory()->create();

        $payload = [
            'location_id' => fake()->randomNumber(),
            'condition_of_ppe' => fake()->word(),
            'remarks' => fake()->paragraph(),
        ];

        $response = $this->putJson("/api/location_conditions/{$model->getKey()}", $payload);

        $response->assertOk();
    }

    public function test_can_delete_location_condition(): void
    {
        $model = LocationCondition::factory()->create();

        $response = $this->deleteJson("/api/location_conditions/{$model->getKey()}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('location_conditions', ['id' => $model->getKey()]);
    }
}
