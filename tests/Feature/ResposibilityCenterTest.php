<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\ResposibilityCenter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResposibilityCenterTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_resposibility_centers(): void
    {
        ResposibilityCenter::factory()->count(3)->create();

        $response = $this->getJson('/api/resposibility_centers');

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_can_create_resposibility_center(): void
    {
        $payload = [
            'responsibility_center_name' => fake()->name(),
            '}' => fake()->word(),
        ];

        $response = $this->postJson('/api/resposibility_centers', $payload);

        $response->assertCreated();
        $this->assertDatabaseHas('resposibility_centers', [
            'responsibility_center_name' => $payload['responsibility_center_name'],
        ]);
    }

    public function test_can_show_resposibility_center(): void
    {
        $model = ResposibilityCenter::factory()->create();

        $response = $this->getJson("/api/resposibility_centers/{$model->getKey()}");

        $response->assertOk()
            ->assertJsonFragment(['id' => $model->getKey()]);
    }

    public function test_can_update_resposibility_center(): void
    {
        $model = ResposibilityCenter::factory()->create();

        $payload = [
            'responsibility_center_name' => fake()->name(),
            '}' => fake()->word(),
        ];

        $response = $this->putJson("/api/resposibility_centers/{$model->getKey()}", $payload);

        $response->assertOk();
    }

    public function test_can_delete_resposibility_center(): void
    {
        $model = ResposibilityCenter::factory()->create();

        $response = $this->deleteJson("/api/resposibility_centers/{$model->getKey()}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('resposibility_centers', ['id' => $model->getKey()]);
    }
}
