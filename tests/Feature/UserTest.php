<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_users(): void
    {
        User::factory()->count(3)->create();

        $response = $this->getJson('/api/users');

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_can_create_user(): void
    {
        $payload = [
            'table' => fake()->word(),
            'username' => fake()->name(),
            'role_id' => fake()->randomNumber(),
            '}' => fake()->word(),
        ];

        $response = $this->postJson('/api/users', $payload);

        $response->assertCreated();
        $this->assertDatabaseHas('users', [
            'table' => $payload['table'],
        ]);
    }

    public function test_can_show_user(): void
    {
        $model = User::factory()->create();

        $response = $this->getJson("/api/users/{$model->getKey()}");

        $response->assertOk()
            ->assertJsonFragment(['id' => $model->getKey()]);
    }

    public function test_can_update_user(): void
    {
        $model = User::factory()->create();

        $payload = [
            'table' => fake()->word(),
            'username' => fake()->name(),
            'role_id' => fake()->randomNumber(),
            '}' => fake()->word(),
        ];

        $response = $this->putJson("/api/users/{$model->getKey()}", $payload);

        $response->assertOk();
    }

    public function test_can_delete_user(): void
    {
        $model = User::factory()->create();

        $response = $this->deleteJson("/api/users/{$model->getKey()}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('users', ['id' => $model->getKey()]);
    }
}
