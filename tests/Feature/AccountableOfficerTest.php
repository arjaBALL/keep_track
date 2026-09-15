<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\AccountableOfficer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountableOfficerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_accountable_officers(): void
    {
        AccountableOfficer::factory()->count(3)->create();

        $response = $this->getJson('/api/accountable_officers');

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_can_create_accountable_officer(): void
    {
        $payload = [
            'name' => fake()->name(),
        ];

        $response = $this->postJson('/api/accountable_officers', $payload);

        $response->assertCreated();
        $this->assertDatabaseHas('accountable_officers', [
            'name' => $payload['name'],
        ]);
    }

    public function test_can_show_accountable_officer(): void
    {
        $model = AccountableOfficer::factory()->create();

        $response = $this->getJson("/api/accountable_officers/{$model->getKey()}");

        $response->assertOk()
            ->assertJsonFragment(['id' => $model->getKey()]);
    }

    public function test_can_update_accountable_officer(): void
    {
        $model = AccountableOfficer::factory()->create();

        $payload = [
            'name' => fake()->name(),
        ];

        $response = $this->putJson("/api/accountable_officers/{$model->getKey()}", $payload);

        $response->assertOk();
    }

    public function test_can_delete_accountable_officer(): void
    {
        $model = AccountableOfficer::factory()->create();

        $response = $this->deleteJson("/api/accountable_officers/{$model->getKey()}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('accountable_officers', ['id' => $model->getKey()]);
    }
}
