<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\AccountabilityPhysicalCount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountabilityPhysicalCountTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_accountability_physical_counts(): void
    {
        AccountabilityPhysicalCount::factory()->count(3)->create();

        $response = $this->getJson('/api/accountability_physical_counts');

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_can_create_accountability_physical_count(): void
    {
        $payload = [
            'balance_per_card' => fake()->randomNumber(),
            'on_hand_per_count' => fake()->randomNumber(),
            'responsibility_center_id' => fake()->randomNumber(),
            'accountable_officer_id' => fake()->randomNumber(),
        ];

        $response = $this->postJson('/api/accountability_physical_counts', $payload);

        $response->assertCreated();
        $this->assertDatabaseHas('accountability_physical_counts', [
            'balance_per_card' => $payload['balance_per_card'],
        ]);
    }

    public function test_can_show_accountability_physical_count(): void
    {
        $model = AccountabilityPhysicalCount::factory()->create();

        $response = $this->getJson("/api/accountability_physical_counts/{$model->getKey()}");

        $response->assertOk()
            ->assertJsonFragment(['id' => $model->getKey()]);
    }

    public function test_can_update_accountability_physical_count(): void
    {
        $model = AccountabilityPhysicalCount::factory()->create();

        $payload = [
            'balance_per_card' => fake()->randomNumber(),
            'on_hand_per_count' => fake()->randomNumber(),
            'responsibility_center_id' => fake()->randomNumber(),
            'accountable_officer_id' => fake()->randomNumber(),
        ];

        $response = $this->putJson("/api/accountability_physical_counts/{$model->getKey()}", $payload);

        $response->assertOk();
    }

    public function test_can_delete_accountability_physical_count(): void
    {
        $model = AccountabilityPhysicalCount::factory()->create();

        $response = $this->deleteJson("/api/accountability_physical_counts/{$model->getKey()}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('accountability_physical_counts', ['id' => $model->getKey()]);
    }
}
