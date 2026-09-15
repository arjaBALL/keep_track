<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DescriptionAcquisition;
use App\Http\Requests\StoreDescriptionAcquisitionRequest;
use App\Http\Requests\UpdateDescriptionAcquisitionRequest;
use App\Http\Resources\DescriptionAcquisitionResource;
use App\Services\DescriptionAcquisitionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DescriptionAcquisitionController extends Controller
{
    public function __construct(
        private readonly DescriptionAcquisitionService $service,
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $items = $this->service->paginate();

        return DescriptionAcquisitionResource::collection($items);
    }

    public function store(StoreDescriptionAcquisitionRequest $request): JsonResponse
    {
        $model = $this->service->create($request->validated());

        return (new DescriptionAcquisitionResource($model))
            ->response()
            ->setStatusCode(201);
    }

    public function show(DescriptionAcquisition $descriptionAcquisition): DescriptionAcquisitionResource
    {
        $model = $this->service->find($descriptionAcquisition->getKey());

        return new DescriptionAcquisitionResource($model);
    }

    public function update(UpdateDescriptionAcquisitionRequest $request, DescriptionAcquisition $descriptionAcquisition): DescriptionAcquisitionResource
    {
        $model = $this->service->update($descriptionAcquisition, $request->validated());

        return new DescriptionAcquisitionResource($model);
    }

    public function destroy(DescriptionAcquisition $descriptionAcquisition): JsonResponse
    {
        $this->service->delete($descriptionAcquisition);

        return response()->json(null, 204);
    }
}
