<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\PropertyClass;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyClassTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_property_classes(): void
    {
        PropertyClass::factory()->count(3)->create();

        $response = $this->getJson('/api/property_classes');

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_can_create_property_class(): void
    {
        $payload = [
            'property_type_name' => fake()->name(),
            '}' => fake()->word(),
        ];

        $response = $this->postJson('/api/property_classes', $payload);

        $response->assertCreated();
        $this->assertDatabaseHas('property_classes', [
            'property_type_name' => $payload['property_type_name'],
        ]);
    }

    public function test_can_show_property_class(): void
    {
        $model = PropertyClass::factory()->create();

        $response = $this->getJson("/api/property_classes/{$model->getKey()}");

        $response->assertOk()
            ->assertJsonFragment(['id' => $model->getKey()]);
    }

    public function test_can_update_property_class(): void
    {
        $model = PropertyClass::factory()->create();

        $payload = [
            'property_type_name' => fake()->name(),
            '}' => fake()->word(),
        ];

        $response = $this->putJson("/api/property_classes/{$model->getKey()}", $payload);

        $response->assertOk();
    }

    public function test_can_delete_property_class(): void
    {
        $model = PropertyClass::factory()->create();

        $response = $this->deleteJson("/api/property_classes/{$model->getKey()}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('property_classes', ['id' => $model->getKey()]);
    }
}
