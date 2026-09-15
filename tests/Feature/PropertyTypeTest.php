<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\PropertyType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_property_types(): void
    {
        PropertyType::factory()->count(3)->create();

        $response = $this->getJson('/api/property_types');

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_can_create_property_type(): void
    {
        $payload = [
            'property_type_name' => fake()->name(),
            '}' => fake()->word(),
        ];

        $response = $this->postJson('/api/property_types', $payload);

        $response->assertCreated();
        $this->assertDatabaseHas('property_types', [
            'property_type_name' => $payload['property_type_name'],
        ]);
    }

    public function test_can_show_property_type(): void
    {
        $model = PropertyType::factory()->create();

        $response = $this->getJson("/api/property_types/{$model->getKey()}");

        $response->assertOk()
            ->assertJsonFragment(['id' => $model->getKey()]);
    }

    public function test_can_update_property_type(): void
    {
        $model = PropertyType::factory()->create();

        $payload = [
            'property_type_name' => fake()->name(),
            '}' => fake()->word(),
        ];

        $response = $this->putJson("/api/property_types/{$model->getKey()}", $payload);

        $response->assertOk();
    }

    public function test_can_delete_property_type(): void
    {
        $model = PropertyType::factory()->create();

        $response = $this->deleteJson("/api/property_types/{$model->getKey()}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('property_types', ['id' => $model->getKey()]);
    }
}
