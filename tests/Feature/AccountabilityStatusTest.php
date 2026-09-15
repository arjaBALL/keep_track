<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\AccountabilityStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountabilityStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_accountability_statuses(): void
    {
        AccountabilityStatus::factory()->count(3)->create();

        $response = $this->getJson('/api/accountability_statuses');

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_can_create_accountability_status(): void
    {
        $payload = [
            'status_id' => fake()->randomNumber(),
            'are_on' => now()->toDateTimeString(),
        ];

        $response = $this->postJson('/api/accountability_statuses', $payload);

        $response->assertCreated();
        $this->assertDatabaseHas('accountability_statuses', [
            'status_id' => $payload['status_id'],
        ]);
    }

    public function test_can_show_accountability_status(): void
    {
        $model = AccountabilityStatus::factory()->create();

        $response = $this->getJson("/api/accountability_statuses/{$model->getKey()}");

        $response->assertOk()
            ->assertJsonFragment(['id' => $model->getKey()]);
    }

    public function test_can_update_accountability_status(): void
    {
        $model = AccountabilityStatus::factory()->create();

        $payload = [
            'status_id' => fake()->randomNumber(),
            'are_on' => now()->toDateTimeString(),
        ];

        $response = $this->putJson("/api/accountability_statuses/{$model->getKey()}", $payload);

        $response->assertOk();
    }

    public function test_can_delete_accountability_status(): void
    {
        $model = AccountabilityStatus::factory()->create();

        $response = $this->deleteJson("/api/accountability_statuses/{$model->getKey()}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('accountability_statuses', ['id' => $model->getKey()]);
    }
}
