<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\AccountCode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountCodeTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_account_codes(): void
    {
        AccountCode::factory()->count(3)->create();

        $response = $this->getJson('/api/account_codes');

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_can_create_account_code(): void
    {
        $payload = [
            'code' => fake()->randomNumber(),
            '}' => fake()->word(),
        ];

        $response = $this->postJson('/api/account_codes', $payload);

        $response->assertCreated();
        $this->assertDatabaseHas('account_codes', [
            'code' => $payload['code'],
        ]);
    }

    public function test_can_show_account_code(): void
    {
        $model = AccountCode::factory()->create();

        $response = $this->getJson("/api/account_codes/{$model->getKey()}");

        $response->assertOk()
            ->assertJsonFragment(['id' => $model->getKey()]);
    }

    public function test_can_update_account_code(): void
    {
        $model = AccountCode::factory()->create();

        $payload = [
            'code' => fake()->randomNumber(),
            '}' => fake()->word(),
        ];

        $response = $this->putJson("/api/account_codes/{$model->getKey()}", $payload);

        $response->assertOk();
    }

    public function test_can_delete_account_code(): void
    {
        $model = AccountCode::factory()->create();

        $response = $this->deleteJson("/api/account_codes/{$model->getKey()}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('account_codes', ['id' => $model->getKey()]);
    }
}
