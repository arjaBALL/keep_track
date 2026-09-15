<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\DescriptionAcquisition;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DescriptionAcquisitionTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_description_acquisitions(): void
    {
        DescriptionAcquisition::factory()->count(3)->create();

        $response = $this->getJson('/api/description_acquisitions');

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_can_create_description_acquisition(): void
    {
        $payload = [
            'acquisition_date' => now()->toDateTimeString(),
            'quantity' => fake()->randomNumber(),
            'unit' => fake()->word(),
            'description' => fake()->word(),
        ];

        $response = $this->postJson('/api/description_acquisitions', $payload);

        $response->assertCreated();
        $this->assertDatabaseHas('description_acquisitions', [
            'acquisition_date' => $payload['acquisition_date'],
        ]);
    }

    public function test_can_show_description_acquisition(): void
    {
        $model = DescriptionAcquisition::factory()->create();

        $response = $this->getJson("/api/description_acquisitions/{$model->getKey()}");

        $response->assertOk()
            ->assertJsonFragment(['id' => $model->getKey()]);
    }

    public function test_can_update_description_acquisition(): void
    {
        $model = DescriptionAcquisition::factory()->create();

        $payload = [
            'acquisition_date' => now()->toDateTimeString(),
            'quantity' => fake()->randomNumber(),
            'unit' => fake()->word(),
            'description' => fake()->word(),
        ];

        $response = $this->putJson("/api/description_acquisitions/{$model->getKey()}", $payload);

        $response->assertOk();
    }

    public function test_can_delete_description_acquisition(): void
    {
        $model = DescriptionAcquisition::factory()->create();

        $response = $this->deleteJson("/api/description_acquisitions/{$model->getKey()}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('description_acquisitions', ['id' => $model->getKey()]);
    }
}
