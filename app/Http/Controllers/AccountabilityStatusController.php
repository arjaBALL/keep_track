<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AccountabilityStatus;
use App\Http\Requests\StoreAccountabilityStatusRequest;
use App\Http\Requests\UpdateAccountabilityStatusRequest;
use App\Http\Resources\AccountabilityStatusResource;
use App\Services\AccountabilityStatusService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AccountabilityStatusController extends Controller
{
    public function __construct(
        private readonly AccountabilityStatusService $service,
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $items = $this->service->paginate();

        return AccountabilityStatusResource::collection($items);
    }

    public function store(StoreAccountabilityStatusRequest $request): JsonResponse
    {
        $model = $this->service->create($request->validated());

        return (new AccountabilityStatusResource($model))
            ->response()
            ->setStatusCode(201);
    }

    public function show(AccountabilityStatus $accountabilityStatus): AccountabilityStatusResource
    {
        $model = $this->service->find($accountabilityStatus->getKey());

        return new AccountabilityStatusResource($model);
    }

    public function update(UpdateAccountabilityStatusRequest $request, AccountabilityStatus $accountabilityStatus): AccountabilityStatusResource
    {
        $model = $this->service->update($accountabilityStatus, $request->validated());

        return new AccountabilityStatusResource($model);
    }

    public function destroy(AccountabilityStatus $accountabilityStatus): JsonResponse
    {
        $this->service->delete($accountabilityStatus);

        return response()->json(null, 204);
    }
}
