<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\InventoryRegistration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InventoryRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_inventory_registrations(): void
    {
        InventoryRegistration::factory()->count(3)->create();

        $response = $this->getJson('/api/inventory_registrations');

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_can_create_inventory_registration(): void
    {
        $payload = [
            'classification_id' => fake()->randomNumber(),
            'identification_id' => fake()->randomNumber(),
            'description_id' => fake()->randomNumber(),
            'valuation_id' => fake()->randomNumber(),
            'accountability_id' => fake()->randomNumber(),
            'location_id' => fake()->randomNumber(),
            'status_id' => fake()->randomNumber(),
        ];

        $response = $this->postJson('/api/inventory_registrations', $payload);

        $response->assertCreated();
        $this->assertDatabaseHas('inventory_registrations', [
            'classification_id' => $payload['classification_id'],
        ]);
    }

    public function test_can_show_inventory_registration(): void
    {
        $model = InventoryRegistration::factory()->create();

        $response = $this->getJson("/api/inventory_registrations/{$model->getKey()}");

        $response->assertOk()
            ->assertJsonFragment(['id' => $model->getKey()]);
    }

    public function test_can_update_inventory_registration(): void
    {
        $model = InventoryRegistration::factory()->create();

        $payload = [
            'classification_id' => fake()->randomNumber(),
            'identification_id' => fake()->randomNumber(),
            'description_id' => fake()->randomNumber(),
            'valuation_id' => fake()->randomNumber(),
            'accountability_id' => fake()->randomNumber(),
            'location_id' => fake()->randomNumber(),
            'status_id' => fake()->randomNumber(),
        ];

        $response = $this->putJson("/api/inventory_registrations/{$model->getKey()}", $payload);

        $response->assertOk();
    }

    public function test_can_delete_inventory_registration(): void
    {
        $model = InventoryRegistration::factory()->create();

        $response = $this->deleteJson("/api/inventory_registrations/{$model->getKey()}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('inventory_registrations', ['id' => $model->getKey()]);
    }
}
