<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\ValuationDepreciation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ValuationDepreciationTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_valuation_depreciations(): void
    {
        ValuationDepreciation::factory()->count(3)->create();

        $response = $this->getJson('/api/valuation_depreciations');

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_can_create_valuation_depreciation(): void
    {
        $payload = [
            'estimated_life' => fake()->randomNumber(),
            'unit_value' => fake()->randomFloat(2, 1, 999),
            'salvage_value' => fake()->randomFloat(2, 1, 999),
            'monthly_depreciation' => fake()->randomFloat(2, 1, 999),
            'month_id' => fake()->randomNumber(),
            'accumulated_depreciation' => fake()->randomFloat(2, 1, 999),
            'net_book_value' => fake()->randomFloat(2, 1, 999),
        ];

        $response = $this->postJson('/api/valuation_depreciations', $payload);

        $response->assertCreated();
        $this->assertDatabaseHas('valuation_depreciations', [
            'estimated_life' => $payload['estimated_life'],
        ]);
    }

    public function test_can_show_valuation_depreciation(): void
    {
        $model = ValuationDepreciation::factory()->create();

        $response = $this->getJson("/api/valuation_depreciations/{$model->getKey()}");

        $response->assertOk()
            ->assertJsonFragment(['id' => $model->getKey()]);
    }

    public function test_can_update_valuation_depreciation(): void
    {
        $model = ValuationDepreciation::factory()->create();

        $payload = [
            'estimated_life' => fake()->randomNumber(),
            'unit_value' => fake()->randomFloat(2, 1, 999),
            'salvage_value' => fake()->randomFloat(2, 1, 999),
            'monthly_depreciation' => fake()->randomFloat(2, 1, 999),
            'month_id' => fake()->randomNumber(),
            'accumulated_depreciation' => fake()->randomFloat(2, 1, 999),
            'net_book_value' => fake()->randomFloat(2, 1, 999),
        ];

        $response = $this->putJson("/api/valuation_depreciations/{$model->getKey()}", $payload);

        $response->assertOk();
    }

    public function test_can_delete_valuation_depreciation(): void
    {
        $model = ValuationDepreciation::factory()->create();

        $response = $this->deleteJson("/api/valuation_depreciations/{$model->getKey()}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('valuation_depreciations', ['id' => $model->getKey()]);
    }
}
