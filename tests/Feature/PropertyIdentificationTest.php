<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\PropertyIdentification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyIdentificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_property_identifications(): void
    {
        PropertyIdentification::factory()->count(3)->create();

        $response = $this->getJson('/api/property_identifications');

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_can_create_property_identification(): void
    {
        $payload = [
            'ics_par_no' => fake()->word(),
            'ics_par_date' => now()->toDateTimeString(),
            'engas_old_property_no' => fake()->word(),
            'old_property_no' => fake()->word(),
            'new_property_no' => fake()->word(),
        ];

        $response = $this->postJson('/api/property_identifications', $payload);

        $response->assertCreated();
        $this->assertDatabaseHas('property_identifications', [
            'ics_par_no' => $payload['ics_par_no'],
        ]);
    }

    public function test_can_show_property_identification(): void
    {
        $model = PropertyIdentification::factory()->create();

        $response = $this->getJson("/api/property_identifications/{$model->getKey()}");

        $response->assertOk()
            ->assertJsonFragment(['id' => $model->getKey()]);
    }

    public function test_can_update_property_identification(): void
    {
        $model = PropertyIdentification::factory()->create();

        $payload = [
            'ics_par_no' => fake()->word(),
            'ics_par_date' => now()->toDateTimeString(),
            'engas_old_property_no' => fake()->word(),
            'old_property_no' => fake()->word(),
            'new_property_no' => fake()->word(),
        ];

        $response = $this->putJson("/api/property_identifications/{$model->getKey()}", $payload);

        $response->assertOk();
    }

    public function test_can_delete_property_identification(): void
    {
        $model = PropertyIdentification::factory()->create();

        $response = $this->deleteJson("/api/property_identifications/{$model->getKey()}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('property_identifications', ['id' => $model->getKey()]);
    }
}
