<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PropertyClass;
use App\Http\Requests\StorePropertyClassRequest;
use App\Http\Requests\UpdatePropertyClassRequest;
use App\Http\Resources\PropertyClassResource;
use App\Services\PropertyClassService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PropertyClassController extends Controller
{
    public function __construct(
        private readonly PropertyClassService $service,
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $items = $this->service->paginate();

        return PropertyClassResource::collection($items);
    }

    public function store(StorePropertyClassRequest $request): JsonResponse
    {
        $model = $this->service->create($request->validated());

        return (new PropertyClassResource($model))
            ->response()
            ->setStatusCode(201);
    }

    public function show(PropertyClass $propertyClass): PropertyClassResource
    {
        $model = $this->service->find($propertyClass->getKey());

        return new PropertyClassResource($model);
    }

    public function update(UpdatePropertyClassRequest $request, PropertyClass $propertyClass): PropertyClassResource
    {
        $model = $this->service->update($propertyClass, $request->validated());

        return new PropertyClassResource($model);
    }

    public function destroy(PropertyClass $propertyClass): JsonResponse
    {
        $this->service->delete($propertyClass);

        return response()->json(null, 204);
    }
}
