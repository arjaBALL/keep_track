<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AccountabilityPhysicalCount;
use App\Http\Requests\StoreAccountabilityPhysicalCountRequest;
use App\Http\Requests\UpdateAccountabilityPhysicalCountRequest;
use App\Http\Resources\AccountabilityPhysicalCountResource;
use App\Services\AccountabilityPhysicalCountService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AccountabilityPhysicalCountController extends Controller
{
    public function __construct(
        private readonly AccountabilityPhysicalCountService $service,
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $items = $this->service->paginate();

        return AccountabilityPhysicalCountResource::collection($items);
    }

    public function store(StoreAccountabilityPhysicalCountRequest $request): JsonResponse
    {
        $model = $this->service->create($request->validated());

        return (new AccountabilityPhysicalCountResource($model))
            ->response()
            ->setStatusCode(201);
    }

    public function show(AccountabilityPhysicalCount $accountabilityPhysicalCount): AccountabilityPhysicalCountResource
    {
        $model = $this->service->find($accountabilityPhysicalCount->getKey());

        return new AccountabilityPhysicalCountResource($model);
    }

    public function update(UpdateAccountabilityPhysicalCountRequest $request, AccountabilityPhysicalCount $accountabilityPhysicalCount): AccountabilityPhysicalCountResource
    {
        $model = $this->service->update($accountabilityPhysicalCount, $request->validated());

        return new AccountabilityPhysicalCountResource($model);
    }

    public function destroy(AccountabilityPhysicalCount $accountabilityPhysicalCount): JsonResponse
    {
        $this->service->delete($accountabilityPhysicalCount);

        return response()->json(null, 204);
    }
}
