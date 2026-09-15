<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ValuationDepreciation;
use App\Http\Requests\StoreValuationDepreciationRequest;
use App\Http\Requests\UpdateValuationDepreciationRequest;
use App\Http\Resources\ValuationDepreciationResource;
use App\Services\ValuationDepreciationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ValuationDepreciationController extends Controller
{
    public function __construct(
        private readonly ValuationDepreciationService $service,
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $items = $this->service->paginate();

        return ValuationDepreciationResource::collection($items);
    }

    public function store(StoreValuationDepreciationRequest $request): JsonResponse
    {
        $model = $this->service->create($request->validated());

        return (new ValuationDepreciationResource($model))
            ->response()
            ->setStatusCode(201);
    }

    public function show(ValuationDepreciation $valuationDepreciation): ValuationDepreciationResource
    {
        $model = $this->service->find($valuationDepreciation->getKey());

        return new ValuationDepreciationResource($model);
    }

    public function update(UpdateValuationDepreciationRequest $request, ValuationDepreciation $valuationDepreciation): ValuationDepreciationResource
    {
        $model = $this->service->update($valuationDepreciation, $request->validated());

        return new ValuationDepreciationResource($model);
    }

    public function destroy(ValuationDepreciation $valuationDepreciation): JsonResponse
    {
        $this->service->delete($valuationDepreciation);

        return response()->json(null, 204);
    }
}
