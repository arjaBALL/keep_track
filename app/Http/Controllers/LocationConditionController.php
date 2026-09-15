<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LocationCondition;
use App\Http\Requests\StoreLocationConditionRequest;
use App\Http\Requests\UpdateLocationConditionRequest;
use App\Http\Resources\LocationConditionResource;
use App\Services\LocationConditionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LocationConditionController extends Controller
{
    public function __construct(
        private readonly LocationConditionService $service,
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $items = $this->service->paginate();

        return LocationConditionResource::collection($items);
    }

    public function store(StoreLocationConditionRequest $request): JsonResponse
    {
        $model = $this->service->create($request->validated());

        return (new LocationConditionResource($model))
            ->response()
            ->setStatusCode(201);
    }

    public function show(LocationCondition $locationCondition): LocationConditionResource
    {
        $model = $this->service->find($locationCondition->getKey());

        return new LocationConditionResource($model);
    }

    public function update(UpdateLocationConditionRequest $request, LocationCondition $locationCondition): LocationConditionResource
    {
        $model = $this->service->update($locationCondition, $request->validated());

        return new LocationConditionResource($model);
    }

    public function destroy(LocationCondition $locationCondition): JsonResponse
    {
        $this->service->delete($locationCondition);

        return response()->json(null, 204);
    }
}
