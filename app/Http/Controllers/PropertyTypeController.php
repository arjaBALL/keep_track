<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use App\Http\Requests\StorePropertyTypeRequest;
use App\Http\Requests\UpdatePropertyTypeRequest;
use App\Http\Resources\PropertyTypeResource;
use App\Services\PropertyTypeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PropertyTypeController extends Controller
{
    public function __construct(
        private readonly PropertyTypeService $service,
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $items = $this->service->paginate();

        return PropertyTypeResource::collection($items);
    }

    public function store(StorePropertyTypeRequest $request): JsonResponse
    {
        $model = $this->service->create($request->validated());

        return (new PropertyTypeResource($model))
            ->response()
            ->setStatusCode(201);
    }

    public function show(PropertyType $propertyType): PropertyTypeResource
    {
        $model = $this->service->find($propertyType->getKey());

        return new PropertyTypeResource($model);
    }

    public function update(UpdatePropertyTypeRequest $request, PropertyType $propertyType): PropertyTypeResource
    {
        $model = $this->service->update($propertyType, $request->validated());

        return new PropertyTypeResource($model);
    }

    public function destroy(PropertyType $propertyType): JsonResponse
    {
        $this->service->delete($propertyType);

        return response()->json(null, 204);
    }
}
