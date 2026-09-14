<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_roles(): void
    {
        Role::factory()->count(3)->create();

        $response = $this->getJson('/api/roles');

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_can_create_role(): void
    {
        $payload = [
            'table' => fake()->word(),
            'role' => fake()->word(),
         
        ];

        $response = $this->postJson('/api/roles', $payload);

        $response->assertCreated();
        $this->assertDatabaseHas('roles', [
            'table' => $payload['table'],
        ]);
    }

    public function test_can_show_role(): void
    {
        $model = Role::factory()->create();

        $response = $this->getJson("/api/roles/{$model->getKey()}");

        $response->assertOk()
            ->assertJsonFragment(['id' => $model->getKey()]);
    }

    public function test_can_update_role(): void
    {
        $model = Role::factory()->create();

        $payload = [
            'table' => fake()->word(),
            'role' => fake()->word(),          
        ];

        $response = $this->putJson("/api/roles/{$model->getKey()}", $payload);

        $response->assertOk();
    }

    public function test_can_delete_role(): void
    {
        $model = Role::factory()->create();

        $response = $this->deleteJson("/api/roles/{$model->getKey()}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('roles', ['id' => $model->getKey()]);
    }
}