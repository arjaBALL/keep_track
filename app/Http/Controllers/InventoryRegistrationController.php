<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\InventoryRegistration;
use App\Http\Requests\StoreInventoryRegistrationRequest;
use App\Http\Requests\UpdateInventoryRegistrationRequest;
use App\Http\Resources\InventoryRegistrationResource;
use App\Services\InventoryRegistrationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InventoryRegistrationController extends Controller
{
    public function __construct(
        private readonly InventoryRegistrationService $service,
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $items = $this->service->paginate();

        return InventoryRegistrationResource::collection($items);
    }

    public function store(StoreInventoryRegistrationRequest $request): JsonResponse
    {
        $model = $this->service->create($request->validated());

        return (new InventoryRegistrationResource($model))
            ->response()
            ->setStatusCode(201);
    }

    public function show(InventoryRegistration $inventoryRegistration): InventoryRegistrationResource
    {
        $model = $this->service->find($inventoryRegistration->getKey());

        return new InventoryRegistrationResource($model);
    }

    public function update(UpdateInventoryRegistrationRequest $request, InventoryRegistration $inventoryRegistration): InventoryRegistrationResource
    {
        $model = $this->service->update($inventoryRegistration, $request->validated());

        return new InventoryRegistrationResource($model);
    }

    public function destroy(InventoryRegistration $inventoryRegistration): JsonResponse
    {
        $this->service->delete($inventoryRegistration);

        return response()->json(null, 204);
    }
}
