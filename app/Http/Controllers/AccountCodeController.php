<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AccountCode;
use App\Http\Requests\StoreAccountCodeRequest;
use App\Http\Requests\UpdateAccountCodeRequest;
use App\Http\Resources\AccountCodeResource;
use App\Services\AccountCodeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AccountCodeController extends Controller
{
    public function __construct(
        private readonly AccountCodeService $service,
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $items = $this->service->paginate();

        return AccountCodeResource::collection($items);
    }

    public function store(StoreAccountCodeRequest $request): JsonResponse
    {
        $model = $this->service->create($request->validated());

        return (new AccountCodeResource($model))
            ->response()
            ->setStatusCode(201);
    }

    public function show(AccountCode $accountCode): AccountCodeResource
    {
        $model = $this->service->find($accountCode->getKey());

        return new AccountCodeResource($model);
    }

    public function update(UpdateAccountCodeRequest $request, AccountCode $accountCode): AccountCodeResource
    {
        $model = $this->service->update($accountCode, $request->validated());

        return new AccountCodeResource($model);
    }

    public function destroy(AccountCode $accountCode): JsonResponse
    {
        $this->service->delete($accountCode);

        return response()->json(null, 204);
    }
}
