<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PropertyIdentification;
use App\Http\Requests\StorePropertyIdentificationRequest;
use App\Http\Requests\UpdatePropertyIdentificationRequest;
use App\Http\Resources\PropertyIdentificationResource;
use App\Services\PropertyIdentificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PropertyIdentificationController extends Controller
{
    public function __construct(
        private readonly PropertyIdentificationService $service,
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $items = $this->service->paginate();

        return PropertyIdentificationResource::collection($items);
    }

    public function store(StorePropertyIdentificationRequest $request): JsonResponse
    {
        $model = $this->service->create($request->validated());

        return (new PropertyIdentificationResource($model))
            ->response()
            ->setStatusCode(201);
    }

    public function show(PropertyIdentification $propertyIdentification): PropertyIdentificationResource
    {
        $model = $this->service->find($propertyIdentification->getKey());

        return new PropertyIdentificationResource($model);
    }

    public function update(UpdatePropertyIdentificationRequest $request, PropertyIdentification $propertyIdentification): PropertyIdentificationResource
    {
        $model = $this->service->update($propertyIdentification, $request->validated());

        return new PropertyIdentificationResource($model);
    }

    public function destroy(PropertyIdentification $propertyIdentification): JsonResponse
    {
        $this->service->delete($propertyIdentification);

        return response()->json(null, 204);
    }
}
