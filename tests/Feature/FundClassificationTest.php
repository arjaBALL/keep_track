<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\FundClassification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FundClassificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_fund_classifications(): void
    {
        FundClassification::factory()->count(3)->create();

        $response = $this->getJson('/api/fund_classifications');

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_can_create_fund_classification(): void
    {
        $payload = [
            'fund_id' => fake()->randomNumber(),
            'account_id' => fake()->randomNumber(),
            'property_class_id' => fake()->randomNumber(),
            'property_type' => fake()->randomNumber(),
        ];

        $response = $this->postJson('/api/fund_classifications', $payload);

        $response->assertCreated();
        $this->assertDatabaseHas('fund_classifications', [
            'fund_id' => $payload['fund_id'],
        ]);
    }

    public function test_can_show_fund_classification(): void
    {
        $model = FundClassification::factory()->create();

        $response = $this->getJson("/api/fund_classifications/{$model->getKey()}");

        $response->assertOk()
            ->assertJsonFragment(['id' => $model->getKey()]);
    }

    public function test_can_update_fund_classification(): void
    {
        $model = FundClassification::factory()->create();

        $payload = [
            'fund_id' => fake()->randomNumber(),
            'account_id' => fake()->randomNumber(),
            'property_class_id' => fake()->randomNumber(),
            'property_type' => fake()->randomNumber(),
        ];

        $response = $this->putJson("/api/fund_classifications/{$model->getKey()}", $payload);

        $response->assertOk();
    }

    public function test_can_delete_fund_classification(): void
    {
        $model = FundClassification::factory()->create();

        $response = $this->deleteJson("/api/fund_classifications/{$model->getKey()}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('fund_classifications', ['id' => $model->getKey()]);
    }
}
