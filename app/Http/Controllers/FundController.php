<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fund;
use App\Http\Requests\StoreFundRequest;
use App\Http\Requests\UpdateFundRequest;
use App\Http\Resources\FundResource;
use App\Services\FundService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FundController extends Controller
{
    public function __construct(
        private readonly FundService $service,
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $items = $this->service->paginate();

        return FundResource::collection($items);
    }

    public function store(StoreFundRequest $request): JsonResponse
    {
        $model = $this->service->create($request->validated());

        return (new FundResource($model))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Fund $fund): FundResource
    {
        $model = $this->service->find($fund->getKey());

        return new FundResource($model);
    }

    public function update(UpdateFundRequest $request, Fund $fund): FundResource
    {
        $model = $this->service->update($fund, $request->validated());

        return new FundResource($model);
    }

    public function destroy(Fund $fund): JsonResponse
    {
        $this->service->delete($fund);

        return response()->json(null, 204);
    }
}
