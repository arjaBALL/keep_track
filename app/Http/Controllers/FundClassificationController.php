<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FundClassification;
use App\Http\Requests\StoreFundClassificationRequest;
use App\Http\Requests\UpdateFundClassificationRequest;
use App\Http\Resources\FundClassificationResource;
use App\Services\FundClassificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FundClassificationController extends Controller
{
    public function __construct(
        private readonly FundClassificationService $service,
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $items = $this->service->paginate();

        return FundClassificationResource::collection($items);
    }

    public function store(StoreFundClassificationRequest $request): JsonResponse
    {
        $model = $this->service->create($request->validated());

        return (new FundClassificationResource($model))
            ->response()
            ->setStatusCode(201);
    }

    public function show(FundClassification $fundClassification): FundClassificationResource
    {
        $model = $this->service->find($fundClassification->getKey());

        return new FundClassificationResource($model);
    }

    public function update(UpdateFundClassificationRequest $request, FundClassification $fundClassification): FundClassificationResource
    {
        $model = $this->service->update($fundClassification, $request->validated());

        return new FundClassificationResource($model);
    }

    public function destroy(FundClassification $fundClassification): JsonResponse
    {
        $this->service->delete($fundClassification);

        return response()->json(null, 204);
    }
}
