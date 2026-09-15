<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Http\Resources\LocationResource;
use App\Services\LocationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LocationController extends Controller
{
    public function __construct(
        private readonly LocationService $service,
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $items = $this->service->paginate();

        return LocationResource::collection($items);
    }

    public function store(StoreLocationRequest $request): JsonResponse
    {
        $model = $this->service->create($request->validated());

        return (new LocationResource($model))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Location $location): LocationResource
    {
        $model = $this->service->find($location->getKey());

        return new LocationResource($model);
    }

    public function update(UpdateLocationRequest $request, Location $location): LocationResource
    {
        $model = $this->service->update($location, $request->validated());

        return new LocationResource($model);
    }

    public function destroy(Location $location): JsonResponse
    {
        $this->service->delete($location);

        return response()->json(null, 204);
    }
}
