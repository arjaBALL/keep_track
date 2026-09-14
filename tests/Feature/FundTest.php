<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Fund;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FundTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_funds(): void
    {
        Fund::factory()->count(3)->create();

        $response = $this->getJson('/api/funds');

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_can_create_fund(): void
    {
        $payload = [
            // no payload
        ];

        $response = $this->postJson('/api/funds', $payload);

        $response->assertCreated();
        $this->assertDatabaseHas('funds', [
            // 
        ]);
    }

    public function test_can_show_fund(): void
    {
        $model = Fund::factory()->create();

        $response = $this->getJson("/api/funds/{$model->getKey()}");

        $response->assertOk()
            ->assertJsonFragment(['id' => $model->getKey()]);
    }

    public function test_can_update_fund(): void
    {
        $model = Fund::factory()->create();

        $payload = [
            // no payload
        ];

        $response = $this->putJson("/api/funds/{$model->getKey()}", $payload);

        $response->assertOk();
    }

    public function test_can_delete_fund(): void
    {
        $model = Fund::factory()->create();

        $response = $this->deleteJson("/api/funds/{$model->getKey()}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('funds', ['id' => $model->getKey()]);
    }
}
