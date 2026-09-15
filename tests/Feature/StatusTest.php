<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_statuses(): void
    {
        Status::factory()->count(3)->create();

        $response = $this->getJson('/api/statuses');

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_can_create_status(): void
    {
        $payload = [
            'table' => fake()->word(),
            'status' => fake()->word(),
            '}' => fake()->word(),
        ];

        $response = $this->postJson('/api/statuses', $payload);

        $response->assertCreated();
        $this->assertDatabaseHas('statuses', [
            'table' => $payload['table'],
        ]);
    }

    public function test_can_show_status(): void
    {
        $model = Status::factory()->create();

        $response = $this->getJson("/api/statuses/{$model->getKey()}");

        $response->assertOk()
            ->assertJsonFragment(['id' => $model->getKey()]);
    }

    public function test_can_update_status(): void
    {
        $model = Status::factory()->create();

        $payload = [
            'table' => fake()->word(),
            'status' => fake()->word(),
            '}' => fake()->word(),
        ];

        $response = $this->putJson("/api/statuses/{$model->getKey()}", $payload);

        $response->assertOk();
    }

    public function test_can_delete_status(): void
    {
        $model = Status::factory()->create();

        $response = $this->deleteJson("/api/statuses/{$model->getKey()}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('statuses', ['id' => $model->getKey()]);
    }
}
